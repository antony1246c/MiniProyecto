<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Edades;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: text/html; charset=utf-8');

$resultado = null;
$repetidas = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = $_POST['numeros'] ?? [];
    $numeros = Utilidades::validarNumerosPositivos($raw);

    if ($numeros === null || count($numeros) !== 5) {
        $error = 'Ingresa exactamente 5 edades válidas.';
    } else {
        $numerosInt = array_map('intval', $numeros);
        $resultado = Edades::clasificarEdades($numerosInt);
        $repetidas = Edades::estadisticasRepetidas($numerosInt);
    }
}

if ($error) {
    echo '<p class="error">' . $error . '</p>';
} elseif ($resultado) {
    echo '<div class="result">
            <div class="stat-grid">';
    
    foreach ($resultado as $categoria => $edades) {
        echo '<div class="stat-box">
                <div class="val">' . count($edades) . '</div>
                <div class="lbl">' . $categoria . '</div>';
        if (!empty($edades)) {
            echo '<div style="font-size:11px; color:var(--text-color); margin-top:4px;">' . implode(', ', $edades) . '</div>';
        }
        echo '</div>';
    }
    
    echo '</div>';

    if (!empty($repetidas)) {
        echo '<div style="margin-top:1rem; padding:0.8rem; background:var(--sidebar-color); border-radius:8px;">
                <p style="font-size:13px; font-weight:600; color:var(--primary-color); margin-bottom:6px;">Edades repetidas:</p>';
        foreach ($repetidas as $edad => $veces) {
            echo '<p style="font-size:13px; color:var(--text-color);">Edad <strong>' . $edad . '</strong> — aparece <strong>' . $veces . '</strong> veces</p>';
        }
        echo '</div>';
    }

    echo '</div>';
}
?>
