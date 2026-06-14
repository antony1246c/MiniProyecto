<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Samar\MiniProyecto\Problemas\Estadisticos;
use Samar\MiniProyecto\Utilidades;

header('Content-Type: text/html; charset=utf-8');

$cantidad = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : null;

// Paso 1: Solo se envió la cantidad
if ($cantidad && !isset($_POST['numeros'])) {
    echo '<form id="form-p7-notas" class="problema-form">
            <input type="hidden" name="cantidad" value="' . $cantidad . '">
            <div class="form-group">
                <label>Ingresa ' . $cantidad . ' notas (1.0 a 5.0):</label>
                <div class="inputs-col" style="grid-template-columns: repeat(' . min($cantidad, 5) . ', 1fr);">
    ';
    
    for ($i = 0; $i < $cantidad; $i++) {
        echo '<div class="form-group">
                <label>Nota ' . ($i + 1) . '</label>
                <input type="number" name="numeros[]" step="0.1" min="1" max="5" placeholder="1.0 - 5.0" required>
            </div>';
    }
    
    echo '</div>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="button" class="btn-calcular" onclick="resetP7()">← Cambiar cantidad</button>
                <button type="submit" class="btn-calcular">Calcular</button>
            </div>
        </form>
        <script>
            function resetP7() {
                document.getElementById("respuesta-p7").innerHTML = "";
                document.getElementById("form-p7").style.display = "block";
            }
            document.getElementById("form-p7-notas").addEventListener("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch("procesar-p7.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("respuesta-p7").innerHTML = data;
                })
                .catch(error => console.error("Error:", error));
            });
        </script>';
}
// Paso 2: Se enviaron cantidad y notas
elseif ($cantidad && isset($_POST['numeros'])) {
    $raw = $_POST['numeros'] ?? [];
    $numeros = Utilidades::validarNotasPanama($raw);

    if ($numeros === null || count($numeros) !== $cantidad) {
        echo '<p class="error">Ingresa exactamente ' . $cantidad . ' notas válidas entre 1.0 y 5.0.</p>';
    } else {
        $resultado = Estadisticos::calcular($numeros);
        echo '<div class="result">
                <div class="stat-grid">
                    <div class="stat-box">
                        <div class="val">' . $resultado['media'] . '</div>
                        <div class="lbl">Promedio</div>
                    </div>
                    <div class="stat-box">
                        <div class="val">' . $resultado['desv_std'] . '</div>
                        <div class="lbl">Desviación estándar</div>
                    </div>
                    <div class="stat-box">
                        <div class="val">' . $resultado['min'] . '</div>
                        <div class="lbl">Nota mínima</div>
                    </div>
                    <div class="stat-box">
                        <div class="val">' . $resultado['max'] . '</div>
                        <div class="lbl">Nota máxima</div>
                    </div>
                </div>
            </div>';
    }
}
?>
