<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoVentas | Reportes y Estadísticas</title>
    <style>
        :root {
            --primary: #e65100;
            --dark: #1e272e;
            --light-bg: #f4f6f9;
            --card-bg: #ffffff;
            --text: #2f3640;
            --green: #00b894;
            --blue: #0984e3;
            --purple: #6c5ce7;
        }
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { margin: 0; background-color: var(--light-bg); color: var(--text); }

        header {
            background: var(--dark);
            color: #fff;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        header h1 { margin: 0; font-size: 22px; display: flex; align-items: center; gap: 10px; }
        header .version-tag { background: var(--green); color: #fff; font-size: 12px; padding: 4px 10px; border-radius: 20px; font-weight: bold; }
        nav a { color: #dcdde1; text-decoration: none; margin-left: 20px; font-weight: 600; padding: 8px 14px; border-radius: 6px; transition: 0.2s; }
        nav a.active, nav a:hover { background: var(--primary); color: #fff; }

        .container { max-width: 1180px; margin: 30px auto; padding: 0 20px; }

        /* Tarjetas KPI */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        .kpi-card {
            background: var(--card-bg);
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            border-left: 5px solid var(--primary);
        }
        .kpi-card.green { border-left-color: var(--green); }
        .kpi-card.blue { border-left-color: var(--blue); }
        .kpi-card.purple { border-left-color: var(--purple); }
        .kpi-title { font-size: 13px; color: #636e72; font-weight: 700; text-transform: uppercase; }
        .kpi-value { font-size: 28px; font-weight: 800; margin-top: 8px; color: var(--dark); }

        .grid-2 { display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px; }
        @media (max-width: 850px) { .grid-2 { grid-template-columns: 1fr; } }

        .card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }
        .card h2 { margin-top: 0; font-size: 18px; color: var(--dark); border-bottom: 1px solid #eee; padding-bottom: 10px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f8f9fa; font-weight: 700; font-size: 12px; text-transform: uppercase; }
        .badge-warn { background: #ffebee; color: #c62828; padding: 4px 10px; border-radius: 12px; font-weight: 700; font-size: 12px; }
    </style>
</head>
<body>

<header>
    <h1>🍽️ RestoVentas <span class="version-tag">v5.0 FINAL</span></h1>
    <nav>
        <a href="index.php">Gestión de Carta</a>
        <a href="pedidos.php">Pedidos en Salón</a>
        <a href="reportes.php" class="active">Reportes y Caja</a>
    </nav>
</header>

<div class="container">
    <!-- Indicadores principales -->
    <div class="kpi-grid">
        <div class="kpi-card green">
            <div class="kpi-title">💰 Ingresos Totales</div>
            <div class="kpi-value" id="kpi-ingresos">S/ 0.00</div>
        </div>
        <div class="kpi-card blue">
            <div class="kpi-title">🧾 Comandas Atendidas</div>
            <div class="kpi-value" id="kpi-pedidos">0</div>
        </div>
        <div class="kpi-card purple">
            <div class="kpi-title">📊 Ticket Promedio</div>
            <div class="kpi-value" id="kpi-promedio">S/ 0.00</div>
        </div>
    </div>

    <div class="grid-2">
        <!-- Ranking de platos -->
        <div class="card">
            <h2>🏆 Platos Más Vendidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Plato</th>
                        <th>Categoría</th>
                        <th>Unid. Vendidas</th>
                        <th>Recaudado</th>
                    </tr>
                </thead>
                <tbody id="tabla-top"></tbody>
            </table>
        </div>

        <!-- Alertas de inventario -->
        <div class="card">
            <h2>⚠️ Alertas de Stock Bajo (≤ 10)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Plato</th>
                        <th>Stock Restante</th>
                    </tr>
                </thead>
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

        const tbodyTop = document.getElementById('tabla-top');
        tbodyTop.innerHTML = '';
        if (data.top_platos.length > 0) {
            data.top_platos.forEach(item => {
                tbodyTop.innerHTML += `
                    <tr>
                        <td><strong>${item.codigo}</strong></td>
                        <td>${item.nombre}</td>
                        <td>${item.categoria}</td>
                        <td><strong>${item.total_vendido}</strong></td>
                        <td style="color:#00b894; font-weight:bold;">S/ ${parseFloat(item.recaudado).toFixed(2)}</td>
                    </tr>
                `;
            });
        } else {
            tbodyTop.innerHTML = '<tr><td colspan="5" style="text-align:center;">Aún no hay ventas registradas.</td></tr>';
        }

        const tbodyAlertas = document.getElementById('tabla-alertas');
        tbodyAlertas.innerHTML = '';
        if (data.stock_bajo.length > 0) {
            data.stock_bajo.forEach(p => {
                tbodyAlertas.innerHTML += `
                    <tr>
                        <td><strong>${p.codigo}</strong></td>
                        <td>${p.nombre}</td>
                        <td><span class="badge-warn">${p.stock} unid.</span></td>
                    </tr>
                `;
            });
        } else {
            tbodyAlertas.innerHTML = '<tr><td colspan="3" style="text-align:center; color:#00b894;">✅ Todo el inventario tiene stock óptimo.</td></tr>';
        }
    }
}

cargarReportes();
</script>

</body>
</html>