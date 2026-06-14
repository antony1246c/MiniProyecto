<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Presupuesto;
use Samar\MiniProyecto\Utilidades;

$presupuesto = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Capturamos el valor del input name="cantidad"
    $cantidad = $_POST['cantidad'] ?? null;

    // 2. Validamos
    if ($cantidad === null || $cantidad < 1) {
        $error = 'Ingresa una cantidad válida.';
    } else {
        // 3. Llamamos al método y guardamos en $presupuesto
        $presupuesto = Presupuesto::calcularPresupuesto((int) $cantidad);
    }
}
?>
?>

<div class="card">
    <h2>Problema 6 — Presupuesto para un hospital</h2>

    <form method="POST" action="?p=6">
        <div class="form-group">
            <label>Ingresa el presupuesto disponible para el hospital:</label>
            <input type="number" name="cantidad" min="1" value="<?= isset($_POST['cantidad'])
                ? Utilidades::sanitizar($_POST['cantidad'])
                : '' ?>" placeholder="Ej: 20,000" required>
        </div>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <?php if ($presupuesto): ?>
        <?php
        // Preparamos datos para la gráfica (Nombres de áreas y montos)
        $labels = json_encode(array_keys($presupuesto));
        $data = json_encode(array_values($presupuesto));
        ?>

        <div class="result">
            <div class="stat-grid">
                <?php foreach ($presupuesto as $categoria => $monto): ?>
                    <div class="stat-box">
                        <!-- Mostramos el monto formateado -->
                        <div class="val">$<?= number_format($monto, 2) ?></div>
                        <div class="lbl"><?= $categoria ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="graficaPresupuesto" width="350" height="350"></canvas>
        </div>

        <script>
            // Cambia 'graficaEdades' por 'graficaPresupuesto' o asegúrate que coincidan
            const canvas = document.getElementById('graficaPresupuesto');
            if (canvas && typeof Chart !== 'undefined') {
                const ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?= $labels ?>,
                        datasets: [{
                            data: <?= $data ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)'
                            ]
                        }]
                    }
                });
            }
        </script>
    <?php endif; ?>
</div>