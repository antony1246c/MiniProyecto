<?php require dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>

<div class="card">
    <h2>Problema 3 — Múltiplos de 4</h2>

    <form id="formMultiplos">
        <div class="form-group">
            <label>Ingresa la cantidad de múltiplos que quieres:</label>
            <input type="number" name="cantidad" step="1" min="1" max="100" placeholder="Ej: 10" required>
        </div>
        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <div id="resultado"></div>
</div>

<script>
document.getElementById('formMultiplos').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    try {
        const response = await fetch('Procesos/calcular_multiplos.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        const resultado = document.getElementById('resultado');

        if (!data.success) {
            resultado.innerHTML = `<p class="error">${data.mensaje}</p>`;
            return;
        }

        let html = '<div class="result">';
        data.multiplos.forEach(multiplo => {
            html += `<div class="stat-box"><div class="val">${multiplo}</div></div>`;
        });
        html += '</div>';
        resultado.innerHTML = html;

    } catch (error) {
        document.getElementById('resultado').innerHTML = `<p class="error">Error al procesar la solicitud.</p>`;
        console.error(error);
    }
});
</script>