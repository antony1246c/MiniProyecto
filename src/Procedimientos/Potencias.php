<?php
namespace Samar\MiniProyecto\Procedimientos;

class Potencias
{
    public static function calcular(int $base, int $limite = 15): array
    {
        $resultado = [];
        for ($i = 1; $i <= $limite; $i++) {
            $resultado[] = [
                'exponente' => $i,
                'valor'     => pow($base, $i)
            ];
        }
        return $resultado;
    }
}