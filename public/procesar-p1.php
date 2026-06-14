<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Estadisticos;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: text/html; charset=utf-8');

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

if ($error) {
    echo '<p class="error">' . $error . '</p>';
} elseif ($resultado) {
    echo '<div class="result">
            <div class="stat-grid">
                <div class="stat-box">
                    <div class="val">' . $resultado['media'] . '</div>
                    <div class="lbl">Media</div>
                </div>
                <div class="stat-box">
                    <div class="val">' . $resultado['desv_std'] . '</div>
                    <div class="lbl">Desviación estándar</div>
                </div>
                <div class="stat-box">
                    <div class="val">' . $resultado['min'] . '</div>
                    <div class="lbl">Mínimo</div>
                </div>
                <div class="stat-box">
                    <div class="val">' . $resultado['max'] . '</div>
                    <div class="lbl">Máximo</div>
                </div>
            </div>
        </div>';
}
?>
