<?php
namespace Samar\MiniProyecto\Procedimientos;

class Edades
{
    public static function clasificarEdades(array $numeros): array
    {
        $edades = [
            'Niños'        => [],
            'Adolescentes' => [],
            'Adultos'      => [],
            'Adulto mayor' => []
        ];

        foreach ($numeros as $p) {
            $p = (int) $p;
            
            // Usar switch(true) para clasificar por rango de edad
            switch (true) {
                case $p < 13:
                    $edades['Niños'][] = $p;
                    break;
                case $p <= 17:
                    $edades['Adolescentes'][] = $p;
                    break;
                case $p <= 64:
                    $edades['Adultos'][] = $p;
                    break;
                default:
                    $edades['Adulto mayor'][] = $p;
            }
        }

        return $edades;
    }
}