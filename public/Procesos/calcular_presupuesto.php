<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\Presupuesto;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: application/json');

$raw = $_POST['cantidad'] ?? '';
$cantidad = Utilidades::validarNumeroPositivo($raw);

if ($cantidad === null || $cantidad < 1) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Ingresa un número entero positivo válido.'
    ]);
    exit;
}

$resultado = Presupuesto::calcularPresupuesto((int) $cantidad);

echo json_encode([
    'success'   => true,
    'resultado' => $resultado
]);