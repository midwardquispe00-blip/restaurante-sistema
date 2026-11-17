<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Pedidos en Salón</title>
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

        .container { max-width: 1240px; margin: 30px auto; padding: 0 24px; }
        .grid-2 { display: grid; grid-template-columns: 1.25fr 1fr; gap: 25px; margin-bottom: 25px; }
        @media (max-width: 860px) { .grid-2 { grid-template-columns: 1fr; } }

        .panel {
            background: var(--white); border-radius: 16px; padding: 26px;
            box-shadow: 0 10px 30px rgba(36, 21, 13, 0.08); border: 1px solid rgba(212, 175, 55, 0.35); margin-bottom: 24px;
        }
        .panel-title { font-family: 'Playfair Display', serif; font-size: 21px; margin: 0 0 16px 0; border-bottom: 2px solid #f2ebe1; padding-bottom: 10px; }

        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; }
        input, select { padding: 11px 14px; border: 1.5px solid #dfd5c8; border-radius: 10px; font-size: 14px; background: #fffdf9; }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f3d06b 100%); color: #1a0f07;
            border: none; padding: 11px 22px; border-radius: 10px; font-weight: 800; cursor: pointer;
        }
        .btn-crimson {
            background: linear-gradient(135deg, var(--crimson) 0%, #c62828 100%); color: #fff;
            border: none; padding: 14px; border-radius: 10px; font-weight: 800; width: 100%; font-size: 16px; cursor: pointer; margin-top: 15px;
        }

        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #f0e6da; font-size: 14px; }
        th { background: var(--wood-mid); color: var(--gold-bright); font-size: 12px; text-transform: uppercase; }

        .alerta { display: none; padding: 15px 20px; background: #1b5e20; color: #fff; border-left: 5px solid var(--gold); border-radius: 10px; margin-bottom: 20px; font-weight: 600; }
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
        <a href="pedidos.php" class="active">🧾 Pedidos en Salón</a>
        <a href="reportes.php">📊 Reportes y Caja</a>
    </nav>
</header>

<div class="container">
    <div id="alerta-pedido" class="alerta"></div>

    <div class="grid-2">
        <div class="panel">
            <h3 class="panel-title">🧾 Tomar Comanda en Salón</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:14px; margin-bottom:14px;">
                <div class="form-group">
                    <label>Mesa / Ubicación</label>
                    <select id="mesa">
                        <option value="Mesa 01">Mesa 01 - Salón Principal</option>
                        <option value="Mesa 02">Mesa 02 - Salón Principal</option>
                        <option value="Mesa 03">Mesa 03 - Terraza</option>
                        <option value="Mesa 04">Mesa 04 - VIP</option>
                        <option value="Para Llevar">Para Llevar / Delivery</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nombre del Cliente</label>
                    <input type="text" id="cliente" placeholder="Ej. Familia Rojas" required>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 2fr 0.7fr auto; gap:10px; align-items:end; background:#faf5ed; padding:14px; border-radius:12px; border:1px dashed var(--gold);">
                <div class="form-group">
                    <label>Seleccionar Plato</label>
                    <select id="select-plato"></select>
                </div>
                <div class="form-group">
                    <label>Cant.</label>
                    <input type="number" id="cantidad" value="1" min="1" max="50">
                </div>
                <button type="button" class="btn-gold" onclick="agregarAlCarrito()">+ Añadir</button>
            </div>

            <table>
                <thead><tr><th>Plato</th><th>Cant.</th><th>Subtotal</th><th></th></tr></thead>
                <tbody id="tabla-carrito"><tr><td colspan="4" style="text-align:center;">Sin platos en la comanda</td></tr></tbody>
            </table>

            <div style="display:flex; justify-content:space-between; align-items:center; background:var(--wood-mid); color:var(--gold-bright); padding:16px 20px; border-radius:10px; margin-top:16px; font-size:20px; font-weight:800;">
                <span>TOTAL A PAGAR:</span>
                <span id="total-pagar">S/ 0.00</span>
            </div>

            <button type="button" class="btn-crimson" onclick="procesarPedido()">✅ Confirmar y Enviar a Cocina</button>
        </div>

        <div class="panel">
            <h3 class="panel-title">🔥 Disponibilidad en Cocina</h3>
            <table>
                <thead><tr><th>Especialidad</th><th>Precio</th><th>Stock</th></tr></thead>
                <tbody id="tabla-stock"></tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <h3 class="panel-title">🕒 Historial de Comandas Atendidas</h3>
        <table>
            <thead><tr><th>N° Ticket</th><th>Mesa</th><th>Cliente</th><th>Platos</th><th>Total</th><th>Estado</th><th>Fecha</th></tr></thead>
            <tbody id="tabla-historial"></tbody>
        </table>
    </div>
</div>

<script>
let catalogoPlatos = [];
let carrito = [];

async function cargarDatosIniciales() {
    const res = await fetch('controllers/carta.php');
    const json = await res.json();
    catalogoPlatos = json.data || [];
    const select = document.getElementById('select-plato');
    const tbodyStock = document.getElementById('tabla-stock');
    select.innerHTML = ''; tbodyStock.innerHTML = '';

    catalogoPlatos.forEach(p => {
        if (p.stock > 0 && p.condicion == 1) {
            select.innerHTML += `<option value="${p.idplato}">${p.nombre} — S/ ${parseFloat(p.precio).toFixed(2)}</option>`;
        }
        tbodyStock.innerHTML += `<tr><td><strong>${p.nombre}</strong></td><td>S/ ${parseFloat(p.precio).toFixed(2)}</td><td>${p.stock} porciones</td></tr>`;
    });
    cargarHistorialPedidos();
}

function agregarAlCarrito() {
    const idplato = document.getElementById('select-plato').value;
    const cantidad = parseInt(document.getElementById('cantidad').value);
    const plato = catalogoPlatos.find(p => p.idplato == idplato);
    if (!plato || cantidad <= 0) return;

    const existente = carrito.find(item => item.idplato == idplato);
    if (existente) {
        if (existente.cantidad + cantidad > plato.stock) return alert('Stock insuficiente en cocina.');
        existente.cantidad += cantidad;
    } else {
        if (cantidad > plato.stock) return alert('Stock insuficiente en cocina.');
        carrito.push({ idplato: plato.idplato, nombre: plato.nombre, precio: parseFloat(plato.precio), cantidad });
    }
    document.getElementById('cantidad').value = 1;
    renderizarCarrito();
}

function quitarDelCarrito(i) { carrito.splice(i, 1); renderizarCarrito(); }

function renderizarCarrito() {
    const tbody = document.getElementById('tabla-carrito');
    tbody.innerHTML = '';
    let total = 0;
    if (carrito.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;">Sin platos en la comanda</td></tr>';
        document.getElementById('total-pagar').textContent = 'S/ 0.00';
        return;
    }
    carrito.forEach((item, i) => {
        const sub = item.precio * item.cantidad;
        total += sub;
        tbody.innerHTML += `<tr><td>${item.nombre}</td><td>${item.cantidad}</td><td><strong>S/ ${sub.toFixed(2)}</strong></td><td><button onclick="quitarDelCarrito(${i})" style="background:#a81c1c; color:#fff; border:none; border-radius:6px; padding:4px 9px; cursor:pointer;">X</button></td></tr>`;
    });
    document.getElementById('total-pagar').textContent = `S/ ${total.toFixed(2)}`;
}

async function procesarPedido() {
    const mesa = document.getElementById('mesa').value;
    const cliente = document.getElementById('cliente').value.trim();
    if (!cliente) return alert('Ingresa el nombre del cliente.');
    if (carrito.length === 0) return alert('Añade al menos un plato.');

    const res = await fetch('controllers/pedidos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, cliente, items: carrito })
    });
    const json = await res.json();
    if (json.status === 'success') {
        const a = document.getElementById('alerta-pedido');
        a.textContent = `✅ ${json.message} — Stock descontado en cocina.`;
        a.style.display = 'block';
        setTimeout(() => a.style.display = 'none', 4000);
        carrito = []; document.getElementById('cliente').value = '';
        renderizarCarrito(); cargarDatosIniciales();
    }
}

async function cargarHistorialPedidos() {
    const res = await fetch('controllers/pedidos.php');
    const json = await res.json();
    const tbody = document.getElementById('tabla-historial');
    tbody.innerHTML = '';
    (json.data || []).forEach(ped => {
        tbody.innerHTML += `<tr><td><strong>#${ped.idpedido}</strong></td><td>${ped.mesa}</td><td>${ped.cliente}</td><td>${ped.cantidad_items} plato(s)</td><td><strong>S/ ${parseFloat(ped.total).toFixed(2)}</strong></td><td>${ped.estado}</td><td>${ped.fecha}</td></tr>`;
    });
}
cargarDatosIniciales();
</script>
</body>
</html>