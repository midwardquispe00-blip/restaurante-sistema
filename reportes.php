<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Reportes y Caja</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --wood-dark: #140c07;
            --wood-mid: #24150d;
            --gold: #d4af37;
            --gold-bright: #f9d976;
            --crimson: #a81c1c;
            --bg-cream: #f8f4ec;
            --white: #ffffff;
            --text-main: #2b1d14;
        }
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { margin: 0; background-color: var(--bg-cream); color: var(--text-main); }

        header {
            background: linear-gradient(90deg, #110905 0%, #2b170e 50%, #110905 100%);
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid var(--gold);
            box-shadow: 0 6px 25px rgba(0,0,0,0.45);
        }
        .brand { display: flex; align-items: center; gap: 16px; text-decoration: none; }
        .brand-logo {
            width: 68px !important;
            height: 68px !important;
            border-radius: 50%;
            border: 2.5px solid var(--gold);
            object-fit: cover;
            box-shadow: 0 0 18px rgba(212, 175, 55, 0.6);
        }
        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            margin: 0;
            font-size: 26px;
            background: linear-gradient(to right, #f9d976, #d4af37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand-text span { font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; color: #e6d7c3; display: block; }

        nav { display: flex; gap: 12px; }
        nav a {
            color: #f3eae0; text-decoration: none; font-weight: 600; font-size: 14px;
            padding: 10px 20px; border-radius: 50px; border: 1px solid rgba(212, 175, 55, 0.3); transition: 0.25s;
        }
        nav a:hover { border-color: var(--gold-bright); color: var(--gold-bright); }
        nav a.active { background: linear-gradient(135deg, var(--crimson) 0%, #d32f2f 100%); color: #fff; border-color: var(--gold); }

        .container { max-width: 1240px; margin: 32px auto; padding: 0 24px; }
        .kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 22px; margin-bottom: 28px; }
        .kpi-card {
            background: linear-gradient(135deg, #24150d 0%, #140c07 100%);
            color: #fff; padding: 24px; border-radius: 16px; border: 1.5px solid var(--gold);
            box-shadow: 0 10px 25px rgba(20, 12, 7, 0.2);
        }
        .kpi-label { font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px; color: #e0d3c3; font-weight: 700; }
        .kpi-val { font-family: 'Playfair Display', serif; font-size: 34px; font-weight: 800; color: var(--gold-bright); margin-top: 8px; }

        .grid-2 { display: grid; grid-template-columns: 1.4fr 1fr; gap: 24px; }
        @media (max-width: 860px) { .grid-2 { grid-template-columns: 1fr; } }

        .panel {
            background: var(--white); border-radius: 16px; padding: 26px;
            box-shadow: 0 10px 30px rgba(36, 21, 13, 0.08); border: 1px solid rgba(212, 175, 55, 0.35);
        }
        .panel-title { font-family: 'Playfair Display', serif; font-size: 21px; margin: 0 0 16px 0; border-bottom: 2px solid #f2ebe1; padding-bottom: 10px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 13px 12px; text-align: left; border-bottom: 1px solid #f0e6da; font-size: 14px; }
        th { background: var(--wood-mid); color: var(--gold-bright); font-size: 12px; text-transform: uppercase; }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="brand">
        <img src="assets/img/logo.jpg" alt="El Rincón del Sabor" class="brand-logo" onerror="this.src='https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=200&q=80'">
        <div class="brand-text">
            <h1>El Rincón del Sabor</h1>
            <span>Restaurante &amp; Tradición Peruana</span>
        </div>
    </a>
    <nav>
        <a href="index.php">🍽️ Carta Gourmet</a>
        <a href="pedidos.php">🧾 Pedidos en Salón</a>
        <a href="reportes.php" class="active">📊 Reportes y Caja</a>
    </nav>
</header>

<div class="container">
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-label">💰 Ingresos Totales en Caja</div>
            <div class="kpi-val" id="kpi-ingresos">S/ 0.00</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">🧾 Total Comandas Atendidas</div>
            <div class="kpi-val" id="kpi-pedidos">0</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">📊 Ticket Promedio por Mesa</div>
            <div class="kpi-val" id="kpi-promedio">S/ 0.00</div>
        </div>
    </div>

    <div class="grid-2">
        <div class="panel">
            <h3 class="panel-title">🏆 Especialidades Más Vendidas</h3>
            <table>
                <thead><tr><th>Código</th><th>Plato</th><th>Categoría</th><th>Vendidos</th><th>Total Recaudado</th></tr></thead>
                <tbody id="tabla-top"></tbody>
            </table>
        </div>
        <div class="panel">
            <h3 class="panel-title">⚠️ Alertas de Stock en Cocina (≤ 10)</h3>
            <table>
                <thead><tr><th>Código</th><th>Especialidad</th><th>Porciones</th></tr></thead>
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
        top.innerHTML = data.top_platos.length ? '' : '<tr><td colspan="5" style="text-align:center;">Aún no hay ventas registradas.</td></tr>';
        data.top_platos.forEach(i => {
            top.innerHTML += `<tr><td><strong>${i.codigo}</strong></td><td>${i.nombre}</td><td>${i.categoria}</td><td><strong>${i.total_vendido}</strong></td><td style="color:#a81c1c; font-weight:800;">S/ ${parseFloat(i.recaudado).toFixed(2)}</td></tr>`;
        });

        const alertTb = document.getElementById('tabla-alertas');
        alertTb.innerHTML = data.stock_bajo.length ? '' : '<tr><td colspan="3" style="text-align:center; color:#1b5e20; font-weight:700;">✅ Todo el stock en cocina está óptimo.</td></tr>';
        data.stock_bajo.forEach(p => {
            alertTb.innerHTML += `<tr><td><strong>${p.codigo}</strong></td><td>${p.nombre}</td><td><span style="background:#ffebee; color:#b71c1c; padding:4px 10px; border-radius:12px; font-weight:700;">${p.stock} unid.</span></td></tr>`;
        });
    }
}
cargarReportes();
</script>
</body>
</html>