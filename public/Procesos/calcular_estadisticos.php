<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\Estadisticos;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: application/json');

$tipo     = $_POST['calculos'] ?? '';
$raw      = $_POST['numeros'] ?? [];
$numeros  = Utilidades::validarNumerosPositivos($raw);

if ($tipo === '1') {

    if ($numeros === null || count($numeros) !== 5) {
        echo json_encode(['success' => false, 'mensaje' => 'Ingresa exactamente 5 números positivos válidos.']);
        exit;
    }

    echo json_encode(['success' => true, 'resultado' => Estadisticos::calcular($numeros)]);

} elseif ($tipo === '2') {

    $cantidad = $_POST['cantidad'] ?? '';
    $notas    = Utilidades::validarNumeroPositivo($cantidad);

    if ($notas === null || $notas < 1) {
        echo json_encode(['success' => false, 'mensaje' => 'Cantidad de notas inválida.']);
        exit;
    }

    $n = (int) $notas;

    if ($numeros === null || count($numeros) !== $n) {
        echo json_encode(['success' => false, 'mensaje' => 'Ingresa exactamente ' . $n . ' números positivos válidos.']);
        exit;
    }

    echo json_encode(['success' => true,  'resultado' => Estadisticos::calcular($numeros)] );

} else {
    echo json_encode(['success' => false, 'mensaje' => 'Tipo inválido.']);
}
