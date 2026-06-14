<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Presupuesto;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: text/html; charset=utf-8');

$presupuesto = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cantidad = $_POST['cantidad'] ?? null;

    if ($cantidad === null || $cantidad < 1) {
        $error = 'Ingresa una cantidad válida.';
    } else {
        $presupuesto = Presupuesto::calcularPresupuesto((int) $cantidad);
    }
}

if ($error) {
    echo '<p class="error">' . $error . '</p>';
} elseif ($presupuesto) {
    $labels = json_encode(array_keys($presupuesto));
    $data = json_encode(array_values($presupuesto));

    echo '<div class="result">
            <div class="stat-grid">';
    
    foreach ($presupuesto as $categoria => $monto) {
        echo '<div class="stat-box">
                <div class="val">$' . number_format($monto, 2) . '</div>
                <div class="lbl">' . $categoria . '</div>
            </div>';
    }
    
    echo '</div>
        </div>

        <div class="chart-container">
            <canvas id="graficaPresupuesto" width="350" height="350"></canvas>
        </div>

        <script>
            const canvas = document.getElementById("graficaPresupuesto");
            if (canvas && typeof Chart !== "undefined") {
                const ctx = canvas.getContext("2d");
                new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: ' . $labels . ',
                        datasets: [{
                            data: ' . $data . ',
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.7)",
                                "rgba(54, 162, 235, 0.7)",
                                "rgba(255, 206, 86, 0.7)"
                            ],
                            borderColor: [
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)",
                                "rgba(255, 206, 86, 1)"
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: "top" }
                        }
                    }
                });
            }
        </script>';
}
?>
