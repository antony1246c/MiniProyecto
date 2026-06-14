<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\SumaNumeros;

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = SumaNumeros::calcular(1, 1000, 1000);
}
?>

<div class="card">
    <h2>Problema 2 — Calcular la suma de los números del 1 al 1,000</h2>

    <form method="POST" action="?p=2">
        <div class="form-group">
            <label>Clickea el botón para realizar el cálculo:</label>
        </div>
        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <div class="formula">
        <span class="textoformula">Fórmula utilizada:</span>
        <img src="https://i.ibb.co/bgYtZL46/images.png" alt="Fórmula estadística">
    </div>
    <?php if ($resultado !== null): ?>
        <div class="result">
            <div class="stat-grid">
                <div class="stat-box">
                    <div class="val"><?= $resultado ?></div>
                    <div class="lbl">Total calculado</div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>