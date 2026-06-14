<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';
?>

<div class="card">
    <h2>Problema 2 — Calcular la suma de los números del 1 al 1,000</h2>

    <form id="formSumaCalculo">
        <input type="hidden" name="calculos" value="1">

        <div class="form-group">
            <label>Clickea el botón para realizar el cálculo:</label>
        </div>
        <button type="submit" class="btn-calcular">Calcular</button>
        
    </form>

    <div class="formula">
        <span class="textoformula">Fórmula utilizada:</span>
        <img src="https://i.ibb.co/bgYtZL46/images.png" alt="Fórmula estadística">
    </div>

    <div id="resultado"></div>
</div>

<script>
    document.getElementById('formSumaCalculo').addEventListener
        ('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch('Procesos/calcular_sumaNumeros',
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
                    <div class="val">${data.resultado}</div>
                    <div class="lbl">Total calculado</div>
                </div>
            </div>
        </div>
        `;

            } catch (error) {

                document.getElementById('resultado').innerHTML = `
            <p class="error">
                Error al procesar la solicitud.
            </p>
        `;

                console.error(error);
            }
        });
</script>
</div>