<?php
namespace Samar\MiniProyecto\Problems;

class Presupuesto
{
    public static function calcularPresupuesto( int $cantidad): array
    {
        $division = [];

        $presupuesto=$cantidad;

        $division['Ginecologia 40%' ]= $presupuesto*0.40;
        $division['Traumatologia 35%']=$presupuesto*0.35;
        $division['Pediatria 25%']=$presupuesto*0.25;

        return $division;
    }
}