<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problems\Multiplos;
use Samar\MiniProyecto\Utilidades;

$multiplos = [];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cantidad = Utilidades::validarNumeroPositivo($_POST['cantidad'] ?? '');

    if ($cantidad === null || $cantidad < 1) {
        $error = 'Ingresa un número entero positivo válido.';
    } else {
        $multiplos = Multiplos::calcular((int) $cantidad);
    }
}
?>

<div class="card">
    <h2>Problema 3 — Múltiplos de 4</h2>

    <form method="POST" action="?p=3">
        <div class="form-group">
            <label>Ingresa la cantidad de múltiplos que quieres:</label>
            <input type="number" name="cantidad" min="1" value="<?= isset($_POST['cantidad'])
                ? Utilidades::sanitizar($_POST['cantidad'])
                : '' ?>" placeholder="Ej: 10" required>
        </div>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <?php if (!empty($multiplos)): ?>
        <div class="result">
            <div class="stat-box">
                <div class="val">
                    <?= implode(', ', $multiplos) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


</div>