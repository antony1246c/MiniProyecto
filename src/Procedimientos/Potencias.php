<?php
namespace Samar\MiniProyecto\Procedimientos;

use Samar\MiniProyecto\Utilidades\Utilidades;

class Potencias
{
    public static function calcular(int $base, int $limite = 15): array
    {
        $resultado = [];

        for ($i = 1; $i <= $limite; $i++) {
            $resultado[] = [
                'exponente' => $i,
                'valor' => Utilidades::potencia($base, $i)
            ];
        }

        return $resultado;
    }
}