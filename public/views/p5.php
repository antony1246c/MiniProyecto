<?php require dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>

<div class="card">
    <h2>Problema 5 — Edades de 5 personas</h2>

    <form id="formEdades">
        <div class="form-group">
            <label>Ingresa 5 edades:</label>
            <div class="inputs-col">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="form-group">
                        <label>Edad <?= $i + 1 ?></label>
                        <input type="number" name="numeros[]" step="1" min="0" max="120" placeholder="E<?= $i + 1 ?>"
                            required>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <button type="submit" class="btn-calcular">Clasificar</button>
    </form>

    <div id="resultado"></div>
    <div class="chart-container">
        <h2 id="TituloGrafica" style="display:none;">Gráfica de las edades:</h2>
        <canvas id="graficaEdades" width="350" height="350"></canvas>
    </div>
</div>

<script>
    let chartEdades = null;

    document.getElementById('formEdades').addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch('Procesos/calcular_edades.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();
            const contenedorResultado = document.getElementById('resultado');

            if (!data.success) {
                contenedorResultado.innerHTML = `<p class="error">${data.mensaje}</p>`;
                return;
            }

            let html = '<div class="stat-grid">';
            Object.entries(data.resultado).forEach(([categoria, edades]) => {
                const cantidad = edades.length;
                const listaEdades = edades.length > 0
                    ? `<div style="font-size:11px; color:var(--text-color); margin-top:4px;">${edades.join(', ')}</div>`
                    : '';
                html += `
                    <div class="stat-box">
                        <div class="val">${cantidad}</div>
                        <div class="lbl">${categoria}</div>
                        ${listaEdades}
                    </div>`;
            });
            html += '</div>';
            contenedorResultado.innerHTML = html;

            
            const labels = Object.keys(data.resultado);

            const valores = Object.values(data.resultado).map(edades => edades.length);

            const canvas = document.getElementById('graficaEdades');

            document.getElementById('TituloGrafica').style.display = 'block';

            if (canvas && typeof Chart !== 'undefined') {
                const chartExistente = Chart.getChart(canvas);
                if (chartExistente) chartExistente.destroy();

                chartEdades = new Chart(canvas.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: valores,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)'
                            ],
                            borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { position: 'top' } }
                    }
                });
            }

        } catch (error) {
            document.getElementById('resultado').innerHTML = `<p class="error">Error al procesar la solicitud.</p>`;
            console.error(error);
        }
    });
</script>