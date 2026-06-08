<?php
namespace Samar\MiniProyecto\Problems;

class SumaNumeros
{
    public static function calcular(int $primero, int $ultimo, int $n): int
    {
        // Fórmula real: n * (a1 + an) / 2
        return ($n * ($primero + $ultimo)) / 2;
    }
}