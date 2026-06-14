<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';
?>

<div class="card">
    <h2>Problema 6 — Presupuesto para un hospital</h2>

    <form id="formPresupuesto">
        <div class="form-group">
            <label>Ingresa el presupuesto disponible para el hospital:</label>
            <input type="number" name="cantidad" min="1" placeholder="Ej: 20,000" required>
        </div>

        <button type="submit" class="btn-calcular">Calcular</button>
    </form>

    <div id="resultado"></div>
    <div class="chart-container">
        <h2 id="TituloGrafica" style="display:none;">Gráfica de los presupuestos:</h2>
        <canvas id="graficaPresupuesto" width="350" height="350"></canvas>
    </div>

    <script>
        let chartPresupuesto = null;

        document.getElementById('formPresupuesto').addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('Procesos/calcular_presupuesto.php', {
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
                Object.entries(data.resultado).forEach(([departamento, monto]) => {
                    html += `
        <div class="stat-box">
            <div class="val">$${monto.toLocaleString()}</div>
            <div class="lbl">${departamento}</div>
        </div>`;
                });
                html += '</div>';
                contenedorResultado.innerHTML = html;

                const labels = Object.keys(data.resultado);
                const valores = Object.values(data.resultado);

                const canvas = document.getElementById('graficaPresupuesto');
                document.getElementById('TituloGrafica').style.display = 'block';


                if (canvas && typeof Chart !== 'undefined') {
                    // Destruye cualquier chart previo en ese canvas, sin importar la variable
                    const chartExistente = Chart.getChart(canvas);
                    if (chartExistente) chartExistente.destroy();

                    chartPresupuesto = new Chart(canvas.getContext('2d'), {
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