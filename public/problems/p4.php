<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problems\SumaNumeros;

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pares = SumaNumeros::calcular(2, 200,100);
    $impares = SumaNumeros::calcular(1, 199,100);
}
?>

<div class="card">
    <h2>Problema 4 — Calcular la suma de los número pares e impares del 1 al 200</h2>

    <form method="POST" action="?p=4">
        <div class="form-group">
            <label>Clickea el botón para realizar el cálculo:</label>
        </div>
        <button type="submit" class="btn-calcular">Calcular</button>
        <div>
            <span>Fórmula utilizada:</span>
            <img src="https://i.ibb.co/bgYtZL46/images.png" alt="Formula estadística">
        </div>
    </form>

    <?php if (!empty($pares) && !empty($impares)): ?>
        <div class="result">
            <div class="stat-grid">
                <div class="stat-box">
                    <div class="val"><?= $pares ?></div>
                    <div class="lbl">Total calculado de los pares</div>
                    <div class="val"><?= $impares ?></div>
                    <div class="lbl">Total calculado de los impares</div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>