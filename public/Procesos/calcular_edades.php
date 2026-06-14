<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\Edades;
use Samar\MiniProyecto\Utilidades\Utilidades;

header('Content-Type: application/json');

$raw = $_POST['numeros'] ?? [];
$numeros = Utilidades::validarNumerosPositivos($raw);

if ($numeros === null || count($numeros) !== 5) {
    echo json_encode(['success' => false, 
    'mensaje' => 'Ingresa exactamente 5 edades válidas.']);
} else {
    $numerosInt = array_map('intval', $numeros);
    $resultado  = Edades::clasificarEdades($numerosInt);

    echo json_encode([
        'success'    => true,
        'resultado'  => $resultado,
        'labels'     => array_keys($resultado),
        'data'       => array_values(array_map('count', $resultado))
    ]);
}