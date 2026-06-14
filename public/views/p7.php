<?php require dirname(__DIR__, 2) . '/vendor/autoload.php'; ?>

<div class="card">
    <h2>Problema 7 — Calculadora de datos estadisticos de notas</h2>

<?php 
$cantidad = isset($_GET['cantidad']) ? (int) $_GET['cantidad'] : 0;

if ($cantidad < 1): ?>

    <form id="formCantidad">
        <div class="form-group">
            <label>¿Cuántas notas deseas ingresar?</label>
            <input id="cantidad" type="number" name="cantidad" min="1" max="50" placeholder="Ej: 5" required>
        </div>
        <button type="submit" class="btn-calcular">Continuar</button>
    </form>

<?php else: ?>

    <form id="formNotas">
        <div class="form-group">
            <label>Ingresa <?= $cantidad ?> notas:</label>
            <div class="inputs-col">
                <?php for ($i = 0; $i < $cantidad; $i++): ?>
                    <div class="form-group">
                        <label>Nota <?= $i + 1 ?></label>
                        <input type="number" name="numeros[]" step="any" min="0" placeholder="Nota <?= $i + 1 ?>" required>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <input type="hidden" name="cantidad" value="<?= $cantidad ?>">
        <input type="hidden" name="calculos" value="2">
        <div style="display:flex; gap:10px;">
            <a href="?p=7" class="btn-calcular" style="text-decoration:none;">← Cambiar cantidad</a>
            <button type="submit" class="btn-calcular">Calcular</button>
        </div>
    </form>

    <div id="resultado"></div>

    <script>
        document.getElementById('formNotas').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('Procesos/calcular_estadisticos.php', {
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
                    <div class="result">
                        <div class="stat-grid">
                            <div class="stat-box">
                                <div class="val">${data.resultado.media}</div>
                                <div class="lbl">Promedio</div>
                            </div>
                            <div class="stat-box">
                                <div class="val">${data.resultado.desv_std}</div>
                                <div class="lbl">Desviación estándar</div>
                            </div>
                            <div class="stat-box">
                                <div class="val">${data.resultado.min}</div>
                                <div class="lbl">Nota mínima</div>
                            </div>
                            <div class="stat-box">
                                <div class="val">${data.resultado.max}</div>
                                <div class="lbl">Nota máxima</div>
                            </div>
                        </div>
                    </div>`;

            } catch (error) {
                resultado.innerHTML = `<p class="error">Error al procesar la solicitud.</p>`;
                console.error(error);
            }
        });
    </script>

<?php endif; ?>
</div>

<script>
    <?php if ($cantidad < 1): ?>
    document.getElementById('formCantidad').addEventListener('submit', function(e) {
        e.preventDefault();
        const cantidad = parseInt(document.getElementById('cantidad').value);
        if (!cantidad || cantidad < 1) return;
        window.location.href = `?p=7&cantidad=${cantidad}`;
    });
    <?php endif; ?>
</script>