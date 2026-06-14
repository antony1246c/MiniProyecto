<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Potencias;
use Samar\MiniProyecto\Utilidades;

$resultado = null;
$error     = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = Utilidades::validarNumeroPositivo($_POST['numero'] ?? '');

    if ($numero === null || $numero < 1 || $numero > 9) {
        $error = 'Ingresa un número entre 1 y 9.';
    } else {
        $resultado = Potencias::calcular((int) $numero);
    }
}
?>

<div class="card">
    <h2>Problema 9 — Potencias</h2>

    <form method="POST" action="?p=9">
        <div class="form-group">
            <label>Ingresa un número del 1 al 9:</label>
            <input type="number" name="numero" min="1" max="9"
                   value="<?= isset($_POST['numero'])
                       ? Utilidades::sanitizar($_POST['numero'])
                       : '' ?>"
                   placeholder="Ej: 4" required>
        </div>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <?php if ($resultado): ?>
        <div class="result">
            <div class="stat-grid">
                <?php foreach ($resultado as $p): ?>
                    <div class="stat-box">
                        <div class="val"><?= number_format($p['valor'], 0, '.', ',') ?></div>
                        <div class="lbl"><?= $_POST['numero'] ?><sup><?= $p['exponente'] ?></sup></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>