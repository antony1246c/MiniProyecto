<?php
namespace Samar\MiniProyecto\Problems;

class Multiplos
{
    public static function calcular(int $cantidad): array
    {
        $resultado = [];

        for ($i = 1; $i <= $cantidad; $i++) {
            $resultado[] = 4 * $i;
        }

        return $resultado;
    }
}
?>