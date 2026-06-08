<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problems\Edades;
use Samar\MiniProyecto\Utilidades;

$resultado = null;
$repetidas = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = $_POST['numeros'] ?? [];
    $numeros = Utilidades::validarNumerosPositivos($raw);

    if ($numeros === null || count($numeros) !== 5) {
        $error = 'Ingresa exactamente 5 edades válidas.';
    } else {
        $numerosInt = array_map('intval', $numeros);
        $resultado = Edades::clasificarEdades($numerosInt);
        $repetidas = Edades::estadisticasRepetidas($numerosInt);
    }
}
?>

<div class="card">
    <h2>Problema 5 — Edades de 5 personas</h2>

    <form method="POST" action="?p=5">
        <div class="form-group">
            <label>Ingresa 5 edades:</label>
            <div class="inputs-col">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="form-group">
                        <label>Edad <?= $i + 1 ?></label>
                        <input type="number" name="numeros[]" step="1" min="0" max="120" value="<?= isset($_POST['numeros'][$i])
                            ? Utilidades::sanitizar($_POST['numeros'][$i])
                            : '' ?>" placeholder="E<?= $i + 1 ?>" required>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit" class="btn-calcular">Clasificar</button>
    </form>

    <?php if ($resultado): ?>
        <?php
        $labels = json_encode(array_keys($resultado));
        $data = json_encode(array_values(array_map('count', $resultado)));
        ?>

        <div class="result">
            <div class="stat-grid">
                <?php foreach ($resultado as $categoria => $edades): ?>
                    <div class="stat-box">
                        <div class="val"><?= count($edades) ?></div>
                        <div class="lbl"><?= $categoria ?></div>
                        <?php if (!empty($edades)): ?>
                            <div style="font-size:11px; color:var(--text-color); margin-top:4px;">
                                <?= implode(', ', $edades) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($repetidas)): ?>
                <div style="margin-top:1rem; padding:0.8rem; background:var(--sidebar-color); border-radius:8px;">
                    <p style="font-size:13px; font-weight:600; color:var(--primary-color); margin-bottom:6px;">
                        Edades repetidas:
                    </p>
                    <?php foreach ($repetidas as $edad => $veces): ?>
                        <p style="font-size:13px; color:var(--text-color);">
                            Edad <strong><?= $edad ?></strong> — aparece <strong><?= $veces ?></strong> veces
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="chart-container">
            <canvas id="graficaEdades" width="350" height="350"></canvas>
        </div>

        <script>
            const canvas = document.getElementById('graficaEdades');

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
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)'
                            ],
                            borderColor: [
                                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' }
                        }
                    }
                });
            }
        </script>

    <?php endif; ?>
</div>