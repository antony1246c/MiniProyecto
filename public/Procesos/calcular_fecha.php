<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\EstacionAnio;
use Samar\MiniProyecto\Utilidades\Utilidades;

header('Content-Type: application/json');

$fecha = Utilidades::sanitizar($_POST['fecha'] ?? '');

if (
    empty($fecha) ||
    !Utilidades::validarFecha($fecha)
) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Ingresa una fecha válida.'
    ]);
    exit;
}

$resultado = EstacionAnio::calcular($fecha);

echo json_encode(['success' => true, 'resultado' => $resultado]);