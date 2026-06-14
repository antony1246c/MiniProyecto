<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Potencias;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: text/html; charset=utf-8');

$resultado = null;
$error = null;
$numero = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = Utilidades::validarNumeroPositivo($_POST['numero'] ?? '');

    if ($numero === null || $numero < 1 || $numero > 9) {
        $error = 'Ingresa un número entre 1 y 9.';
    } else {
        $resultado = Potencias::calcular((int) $numero);
    }
}

if ($error) {
    echo '<p class="error">' . $error . '</p>';
} elseif ($resultado) {
    echo '<div class="result">
            <div class="stat-grid">';
    
    foreach ($resultado as $p) {
        echo '<div class="stat-box">
                <div class="val">' . number_format($p['valor'], 0, '.', ',') . '</div>
                <div class="lbl">' . (int)$numero . '<sup>' . $p['exponente'] . '</sup></div>
            </div>';
    }
    
    echo '</div>
        </div>';
}
?>
