<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Reportes y Caja</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<header>
    <a href="index.php" class="brand">
        <img src="assets/img/logo.jpg" alt="Logo El Rincón del Sabor">
        <div class="brand-text">
            <h1>El Rincón del Sabor</h1>
            <span>Alta Cocina Peruana &amp; Marina</span>
        </div>
    </a>
    <nav>
        <a href="index.php">🍽️ Carta Gourmet</a>
        <a href="pedidos.php">🧾 Pedidos en Salón</a>
        <a href="reportes.php" class="active">📊 Reportes y Caja</a>
    </nav>
</header>

<div class="container">
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px; margin-bottom:26px;">
        <div class="card" style="border-left: 6px solid var(--gold); margin:0;">
            <div style="font-size:12px; font-weight:800; color:var(--text-muted); text-transform:uppercase;">💰 Ingresos Totales</div>
            <div id="kpi-ingresos" style="font-size:30px; font-weight:800; color:var(--wood-dark); margin-top:6px;">S/ 0.00</div>
        </div>
        <div class="card" style="border-left: 6px solid var(--crimson); margin:0;">
            <div style="font-size:12px; font-weight:800; color:var(--text-muted); text-transform:uppercase;">🧾 Comandas Atendidas</div>
            <div id="kpi-pedidos" style="font-size:30px; font-weight:800; color:var(--wood-dark); margin-top:6px;">0</div>
        </div>
        <div class="card" style="border-left: 6px solid #2e7d32; margin:0;">
            <div style="font-size:12px; font-weight:800; color:var(--text-muted); text-transform:uppercase;">📊 Consumo Promedio</div>
            <div id="kpi-promedio" style="font-size:30px; font-weight:800; color:var(--wood-dark); margin-top:6px;">S/ 0.00</div>
        </div>
    </div>

    <div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:24px;">
        <div class="card">
            <h3 class="card-title">🏆 Platos Estrella Más Vendidos</h3>
            <table>
                <thead><tr><th>Código</th><th>Especialidad</th><th>Categoría</th><th>Vendidos</th><th>Recaudado</th></tr></thead>
                <tbody id="tabla-top"></tbody>
            </table>
        </div>
        <div class="card">
            <h3 class="card-title">⚠️ Alertas de Insumos Bajos</h3>
            <table>
                <thead><tr><th>Código</th><th>Especialidad</th><th>Restante</th></tr></thead>
                <tbody id="tabla-alertas"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
async function cargarReportes() {
    const res = await fetch('controllers/reportes.php');
    const data = await res.json();
    if (data.status === 'success') {
        document.getElementById('kpi-ingresos').textContent = `S/ ${parseFloat(data.resumen.ingresos_totales).toFixed(2)}`;
        document.getElementById('kpi-pedidos').textContent = data.resumen.total_pedidos;
        document.getElementById('kpi-promedio').textContent = `S/ ${parseFloat(data.resumen.ticket_promedio).toFixed(2)}`;

        const top = document.getElementById('tabla-top');
        top.innerHTML = data.top_platos.length ? '' : '<tr><td colspan="5" style="text-align:center;">Sin ventas aún.</td></tr>';
        data.top_platos.forEach(i => {
            top.innerHTML += `<tr><td><strong>${i.codigo}</strong></td><td>${i.nombre}</td><td>${i.categoria}</td><td><strong>${i.total_vendido}</strong></td><td style="color:#9e1b1b; font-weight:800;">S/ ${parseFloat(i.recaudado).toFixed(2)}</td></tr>`;
        });

        const alertTb = document.getElementById('tabla-alertas');
        alertTb.innerHTML = data.stock_bajo.length ? '' : '<tr><td colspan="3" style="text-align:center; color:#2e7d32;">✅ Stock completo en cocina.</td></tr>';
        data.stock_bajo.forEach(p => {
            alertTb.innerHTML += `<tr><td><strong>${p.codigo}</strong></td><td>${p.nombre}</td><td><span class="stock-pill low">${p.stock} unid.</span></td></tr>`;
        });
    }
}
cargarReportes();
</script>
</body>
</html>