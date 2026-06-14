<?php
namespace Samar\MiniProyecto\Procedimientos;

class EstacionAnio
{
    public static function calcular(string $fecha): array
    {
        $mes = (int) date('m', strtotime($fecha));
        $dia = (int) date('d', strtotime($fecha));

        switch ($mes) {
            case 12:
                $estacion = ($dia < 21) ? 'Primavera' : 'Verano';
                break;
            case 1:
            case 2:
                $estacion = 'Verano';
                break;
            case 3:
                $estacion = ($dia < 21) ? 'Verano' : 'Otoño';
                break;
            case 4:
            case 5:
                $estacion = 'Otoño';
                break;
            case 6:
                $estacion = ($dia < 22) ? 'Otoño' : 'Invierno';
                break;
            case 7:
            case 8:
                $estacion = 'Invierno';
                break;
            case 9:
                $estacion = ($dia < 23) ? 'Invierno' : 'Primavera';
                break;
            case 10:
            case 11:
                $estacion = 'Primavera';
                break;
            default:
                $estacion = 'Desconocida';
        }

        // Asignación de imagen según estación
        $imagenes = [
            'Primavera' => '../public/assets/img/primavera.png',
            'Verano' => '../public/assets/img/verano.jpg',
            'Otoño' => '../public/assets/img/otono.jpg',
            'Invierno' => '../public/assets/img/invierno.png'
        ];

        $img = $imagenes[$estacion] ?? '../public/assets/img/default.jpg';

        return [
            'estacion' => $estacion,
            'img' => $img,
            'fecha' => date('m-d', strtotime($fecha))
        ];
    }
}