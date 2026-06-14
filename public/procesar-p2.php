<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\SumaNumeros;

header('Content-Type: text/html; charset=utf-8');

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = SumaNumeros::calcular(1, 1000, 1000);
}

if ($resultado !== null) {
    echo '<div class="result">
            <div class="stat-grid">
                <div class="stat-box">
                    <div class="val">' . $resultado . '</div>
                    <div class="lbl">Total calculado</div>
                </div>
            </div>
        </div>';
}
?>
