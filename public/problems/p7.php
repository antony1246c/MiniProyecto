<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problems\Estadisticos;
use Samar\MiniProyecto\Utilidades;

$resultado  = null;
$error      = null;
$cantidad   = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numeros'])) {
    $raw     = $_POST['numeros'] ?? [];
    $numeros = Utilidades::validarNumerosPositivos($raw);

    if ($numeros === null || count($numeros) !== $cantidad) {
        $error = "Ingresa exactamente $cantidad notas válidas.";
    } else {
        $resultado = Estadisticos::calcular($numeros);
    }
}
?>

<div class="card">
    <h2>Problema 7 — Calculadora de Datos Estadísticos</h2>

    <!-- Paso 1: pedir cantidad -->
    <?php if (!$cantidad): ?>
        <form method="POST" action="?p=7">
            <div class="form-group">
                <label>¿Cuántas notas deseas ingresar?</label>
                <input type="number" name="cantidad" min="1" max="50"
                       placeholder="Ej: 5" required>
            </div>
            <button type="submit" class="btn-calcular">Continuar</button>
        </form>

    <!-- Paso 2: ingresar las notas -->
    <?php else: ?>
        <form method="POST" action="?p=7">
            <input type="hidden" name="cantidad" value="<?= $cantidad ?>">
            <div class="form-group">
                <label>Ingresa <?= $cantidad ?> notas:</label>
                <div class="inputs-col" style="grid-template-columns: repeat(<?= min($cantidad, 5) ?>, 1fr);">
                    <?php for ($i = 0; $i < $cantidad; $i++): ?>
                        <div class="form-group">
                            <label>Nota <?= $i + 1 ?></label>
                            <input type="number" name="numeros[]"
                                   step="any" min="0" max="10"
                                   value="<?= isset($_POST['numeros'][$i])
                                       ? Utilidades::sanitizar($_POST['numeros'][$i])
                                       : '' ?>"
                                   placeholder="N<?= $i + 1 ?>" required>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <?php if ($error): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <div style="display:flex; gap:10px;">
                <a href="?p=7" class="btn-calcular" style="text-decoration:none;">← Cambiar cantidad</a>
                <button type="submit" class="btn-calcular">Calcular</button>
            </div>
        </form>

        <?php if ($resultado): ?>
            <div class="result">
                <div class="stat-grid">
                    <div class="stat-box">
                        <div class="val"><?= $resultado['media'] ?></div>
                        <div class="lbl">Promedio</div>
                    </div>
                    <div class="stat-box">
                        <div class="val"><?= $resultado['desv_std'] ?></div>
                        <div class="lbl">Desviación estándar</div>
                    </div>
                    <div class="stat-box">
                        <div class="val"><?= $resultado['min'] ?></div>
                        <div class="lbl">Nota mínima</div>
                    </div>
                    <div class="stat-box">
                        <div class="val"><?= $resultado['max'] ?></div>
                        <div class="lbl">Nota máxima</div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>