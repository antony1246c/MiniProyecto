<?php require dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>

<div class="card">
    <h2>Problema 8 — Estación del Año</h2>

    <form id="formFecha">
        <div class="form-group">
            <label>Ingresa una fecha:</label>
            <input type="date" name="fecha" required>
        </div>
        <button type="submit" class="btn-calcular">Mostrar</button>
    </form>

    <div id="resultado"></div>
</div>

<script>
    document.getElementById('formFecha').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch('Procesos/calcular_fecha.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            const resultado = document.getElementById('resultado');

            if (!data.success) {
                resultado.innerHTML = `<p class="error">${data.mensaje}</p>`;
                return;
            }

            resultado.innerHTML = `
                <div class="result" style="text-align:center;">
                    <p style="font-size:14px; color:var(--text-color);">
                        Fecha ingresada: <strong>${data.resultado.fecha}</strong>
                    </p>
                    <p style="font-size:14px; color:var(--text-color); margin-top:6px;">
                        La estación es: <span class="estacion-nombre">${data.resultado.estacion}</span>
                    </p>
                    <img src="${data.resultado.img}" alt="${data.resultado.estacion}" class="estacion-img">
                </div>`;

        } catch (error) {
            document.getElementById('resultado').innerHTML = `<p class="error">Error al procesar la solicitud.</p>`;
            console.error(error);
        }
    });
</script>