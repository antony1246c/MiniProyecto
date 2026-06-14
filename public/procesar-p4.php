<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\SumaNumeros;

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pares = SumaNumeros::calcular(2, 200, 100);
    $impares = SumaNumeros::calcular(1, 199, 100);

    echo '<div class="result">
            <div class="stat-grid">
                <div class="stat-box">
                    <div class="val">' . $pares . '</div>
                    <div class="lbl">Total calculado de los pares</div>
                </div>
                <div class="stat-box">
                    <div class="val">' . $impares . '</div>
                    <div class="lbl">Total calculado de los impares</div>
                </div>
            </div>
        </div>';
}
?>
