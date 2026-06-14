<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Multiplos;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: text/html; charset=utf-8');

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

if ($error) {
    echo '<p class="error">' . $error . '</p>';
} elseif (!empty($multiplos)) {
    echo '<div class="result">
            <div class="stat-box">
                <div class="val">' . implode(', ', $multiplos) . '</div>
            </div>
        </div>';
}
?>
