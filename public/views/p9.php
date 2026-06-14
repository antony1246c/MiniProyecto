<?php require dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>

<div class="card">
    <h2>Problema 9 — Potencias</h2>

    <form id="formPotencias">
        <div class="form-group">
            <label>Ingresa un número del 1 al 9:</label>
            <input type="number" name="numero" min="1" max="9" placeholder="Ej: 4" required>
        </div>
        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <div id="resultado"></div>
</div>

<script>
document.getElementById('formPotencias').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const numero = formData.get('numero');

    try {
        const response = await fetch('Procesos/calcular_potencias.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        const resultado = document.getElementById('resultado');

        if (!data.success) {
            resultado.innerHTML = `<p class="error">${data.mensaje}</p>`;
            return;
        }

        let html = '<div class="result"><div class="stat-grid">';
        data.potencias.forEach(p => {
            html += `
                <div class="stat-box">
                    <div class="val">${p.valor.toLocaleString()}</div>
                    <div class="lbl">${numero}<sup>${p.exponente}</sup></div>
                </div>`;
        });
        html += '</div></div>';
        resultado.innerHTML = html;

    } catch (error) {
        document.getElementById('resultado').innerHTML = `<p class="error">Error al procesar la solicitud.</p>`;
        console.error(error);
    }
});
</script>