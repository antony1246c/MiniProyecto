<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';
?>

<div class="card">
    <h2>Problema 1 — Estadísticos de 5 números</h2>

    <form id="formEstadisticos">
        <div class="form-group">
            <input type="hidden" name="calculos" value="1">

            <label>Ingresa 5 números positivos:</label>

            <div class="inputs-col">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="form-group">
                        <label>Número <?= $i + 1 ?></label>

                        <input
                            type="number"
                            name="numeros[]"
                            step="any"
                            min="0"
                            placeholder="N<?= $i + 1 ?>"
                            required>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <button type="submit" class="btn-calcular">
            Calcular
        </button>
    </form>

    <div id="resultado"></div>
</div>

<script>
document.getElementById('formEstadisticos')
.addEventListener('submit', async function(e){

    e.preventDefault();

    const formData = new FormData(this);

    try {

        const response = await fetch(
            'Procesos/calcular_estadisticos.php',
            {
                method: 'POST',
                body: formData
            }
        );

        const data = await response.json();

        const resultado = document.getElementById('resultado');

        if (!data.success) {

            resultado.innerHTML = `
                <p class="error">${data.mensaje}</p>
            `;

            return;
        }

        resultado.innerHTML = `
            <div class="result">
                <div class="stat-grid">

                    <div class="stat-box">
                        <div class="val">${data.resultado.media}</div>
                        <div class="lbl">Media</div>
                    </div>

                    <div class="stat-box">
                        <div class="val">${data.resultado.desv_std}</div>
                        <div class="lbl">Desviación estándar</div>
                    </div>

                    <div class="stat-box">
                        <div class="val">${data.resultado.min}</div>
                        <div class="lbl">Mínimo</div>
                    </div>

                    <div class="stat-box">
                        <div class="val">${data.resultado.max}</div>
                        <div class="lbl">Máximo</div>
                    </div>

                </div>
            </div>
        `;

    } catch(error) {

        document.getElementById('resultado').innerHTML = `
            <p class="error">
                Error al procesar la solicitud.
            </p>
        `;

        console.error(error);
    }
});
</script>