<?php
namespace Samar\MiniProyecto;

class Utilidades
{
    // OWASP A03 - sanitizar input del usuario
    public static function sanitizar(string $valor): string
    {
        return htmlspecialchars(strip_tags(trim($valor)));
    }

    // OWASP A03 - validar que sea número positivo
    public static function validarNumeroPositivo(string $valor): ?float
    {
        $limpio = self::sanitizar($valor);
        if (filter_var($limpio, FILTER_VALIDATE_FLOAT) === false) {
            return null;
        }
        $num = (float) $limpio;
        return $num >= 0 ? $num : null;
    }

    // Validar array de números positivos
    public static function validarNumerosPositivos(array $valores): ?array
    {
        $numeros = [];
        foreach ($valores as $v) {
            $n = self::validarNumeroPositivo($v);
            if ($n === null) return null;
            $numeros[] = $n;
        }
        return $numeros;
    }
}