<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Estadisticos;
use Samar\MiniProyecto\Utilidades;

$resultado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = $_POST['numeros'] ?? [];
    $numeros = Utilidades::validarNumerosPositivos($raw);

    if ($numeros === null || count($numeros) !== 5) {
        $error = 'Ingresa exactamente 5 números positivos válidos.';
    } else {
        $resultado = Estadisticos::calcular($numeros);
    }
}
?>

<div class="card">
    <h2>Problema 1 — Estadísticos de 5 números</h2>

    <form method="POST" action="?p=1">
        <div class="form-group">
            <label>Ingresa 5 números positivos:</label>
            <div class="inputs-col">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="form-group">
                        <label>Número <?= $i + 1 ?></label>
                        <input type="number" name="numeros[]" step="any" min="0" value="<?= isset($_POST['numeros'][$i])
                            ? Utilidades::sanitizar($_POST['numeros'][$i])
                            : '' ?>" placeholder="N<?= $i + 1 ?>" required>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <?php if ($resultado): ?>
        <div class="result">
            <div class="stat-grid">
                <div class="stat-box">
                    <div class="val"><?= $resultado['media'] ?></div>
                    <div class="lbl">Media</div>
                </div>
                <div class="stat-box">
                    <div class="val"><?= $resultado['desv_std'] ?></div>
                    <div class="lbl">Desviación estándar</div>
                </div>
                <div class="stat-box">
                    <div class="val"><?= $resultado['min'] ?></div>
                    <div class="lbl">Mínimo</div>
                </div>
                <div class="stat-box">
                    <div class="val"><?= $resultado['max'] ?></div>
                    <div class="lbl">Máximo</div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>