<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\EstacionAnio;
use Samar\MiniProyecto\Utilidades;

$resultado = null;
$error     = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = Utilidades::sanitizar($_POST['fecha'] ?? '');

    if (empty($fecha)) {
        $error = 'Ingresa una fecha válida.';
    } else {
        $resultado = EstacionAnio::calcular($fecha);
    }
}
?>


<div class="card">
    <h2>Problema 8 — Estación del Año</h2>

    <form method="POST" action="?p=8">
        <div class="form-group">
            <label>Ingresa una fecha:</label>
            <input type="date" name="fecha"
                   value="<?= isset($_POST['fecha'])
                       ? Utilidades::sanitizar($_POST['fecha'])
                       : '' ?>" required>
        </div>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button type="submit" class="btn-calcular">Mostrar</button>
    </form>

    <?php if ($resultado): ?>
        <div class="result" style="text-align:center;">
            <p style="font-size:14px; color:var(--text-color);">
                Fecha ingresada: <strong><?= $resultado['fecha'] ?></strong>
            </p>
            <p style="font-size:14px; color:var(--text-color); margin-top:6px;">
                La estación es: <span class="estacion-nombre"><?= $resultado['estacion'] ?></span>
            </p>
            <img src="<?= $resultado['img'] ?>"
                 alt="<?= $resultado['estacion'] ?>"
                 class="estacion-img">
        </div>
    <?php endif; ?>
</div>