<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Procedimientos\SumaNumeros;

header('Content-Type: application/json');

$tipo = $_POST['calculos'] ??'';

if($tipo ==='1'){
    $resultado = SumaNumeros::calcular(1, 1000, 1000);
    echo json_encode(['success' => true, 'resultado' => $resultado]);

}elseif($tipo==='2'){
    $pares = SumaNumeros::calcular(2, 200,100);
    $impares = SumaNumeros::calcular(1, 199,100);
    echo json_encode([
    'success' => true,
    'pares' => $pares,
    'impares' => $impares
]);
}else{
    echo json_encode([
    'success' => false,
    'resultado' => 'No valido'
]);
exit;
}
