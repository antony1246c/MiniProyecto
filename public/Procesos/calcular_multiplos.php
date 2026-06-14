<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\Multiplos;
use Samar\MiniProyecto\Utilidades\Utilidades;

header('Content-Type: application/json');

$numero = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : 0;
$cantidad = Utilidades::validarNumeroPositivo($numero);

if ($cantidad < 1) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Ingresa un número entero positivo válido.'
    ]);
    exit;
}

$multiplos = Multiplos::calcular($cantidad);

echo json_encode([
    'success' => true,
    'multiplos' => $multiplos  
]);