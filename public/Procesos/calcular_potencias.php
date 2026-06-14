<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\Potencias;
use Samar\MiniProyecto\Utilidades\Utilidades;

header('Content-Type: application/json');

$raw    = $_POST['numero'] ?? '';
$numero = Utilidades::validarNumeroPositivo($raw);

if ($numero === null || $numero < 1 || $numero > 9) {
    echo json_encode(['success' => false, 'mensaje' => 'Ingresa un número entre 1 y 9.']);
    exit;
}

echo json_encode([
    'success'   => true,
    'potencias' => Potencias::calcular((int) $numero)
]);