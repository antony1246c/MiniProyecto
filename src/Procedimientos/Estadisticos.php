<?php
namespace Samar\MiniProyecto\Procedimientos;

use Samar\MiniProyecto\Utilidades\Utilidades;

class Estadisticos
{
    public static function calcular(array $numeros): array
    {
        $n = count($numeros);

        $media = array_sum($numeros) / $n;

        $varianza = array_sum(
            array_map(
                fn($x) => Utilidades::potencia($x - $media, 2),
                $numeros
            )
        ) / $n;

        return [
            'media' => round($media, 2),
            'desv_std' => round(
                Utilidades::raizCuadrada($varianza),
                2
            ),
            'min' => min($numeros),
            'max' => max($numeros)
        ];
    }
}