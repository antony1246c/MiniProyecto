<?php
namespace Samar\MiniProyecto\Problems;

class EstacionAnio
{
    public static function calcular(string $fecha): array
    {
        $mes = (int) date('m', strtotime($fecha));
        $dia = (int) date('d', strtotime($fecha));

        // Usamos switch para determinar la estación según el mes
        switch ($mes) {
            case 3:
                $estacion = ($dia < 21) ? 'Invierno' : 'Primavera';
                break;
            case 4:
            case 5:
                $estacion = 'Primavera';
                break;
            case 6:
                $estacion = ($dia < 21) ? 'Primavera' : 'Verano';
                break;
            case 7:
            case 8:
                $estacion = 'Verano';
                break;
            case 9:
                $estacion = ($dia < 23) ? 'Verano' : 'Otoño';
                break;
            case 10:
            case 11:
                $estacion = 'Otoño';
                break;
            case 12:
                $estacion = ($dia < 21) ? 'Otoño' : 'Invierno';
                break;
            case 1:
            case 2:
                $estacion = 'Invierno';
                break;
            default:
                $estacion = 'Desconocida';
        }

        // Asignación de imagen según estación
        $imagenes = [
            'Primavera' => '../src/img/primavera.png',
            'Verano'    => '../src/img/verano.jpg',
            'Otoño'     => '../src/img/otono.jpg',
            'Invierno'  => '../src/img/invierno.png'
        ];

        $img = $imagenes[$estacion] ?? '../src/img/default.jpg';

        return [
            'estacion' => $estacion,
            'img'      => $img,
            'fecha'    => date('m-d', strtotime($fecha))
        ];
    }
}