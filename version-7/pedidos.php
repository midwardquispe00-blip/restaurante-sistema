<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Pedidos y Pagos v6.0</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --wood-dark: #140c07; --wood-mid: #24150d; --gold: #d4af37;
            --gold-bright: #f9d976; --crimson: #a81c1c; --bg-cream: #f8f4ec;
            --white: #ffffff; --text-main: #2b1d14; --wsp: #25D366; --yape: #742284;
        }
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { margin: 0; background-color: var(--bg-cream); color: var(--text-main); }

        header {
            background: linear-gradient(90deg, #110905 0%, #2b170e 50%, #110905 100%);
            padding: 12px 40px; display: flex; justify-content: space-between; align-items: center;
            border-bottom: 3px solid var(--gold); box-shadow: 0 6px 25px rgba(0,0,0,0.45);
        }
        .brand { display: flex; align-items: center; gap: 16px; text-decoration: none; }
        .brand-logo { width: 68px !important; height: 68px !important; border-radius: 50%; border: 2.5px solid var(--gold); object-fit: cover; }
        .brand-text h1 { font-family: 'Playfair Display', serif; margin: 0; font-size: 25px; background: linear-gradient(to right, #f9d976, #d4af37); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .brand-text span { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #e6d7c3; display: block; }
        .v-badge { background: var(--gold); color: #140c07; padding: 2px 8px; border-radius: 12px; font-weight: 800; font-size: 11px; margin-left: 6px; -webkit-text-fill-color: #140c07; }

        nav { display: flex; gap: 12px; align-items: center; }
        nav a { color: #f3eae0; text-decoration: none; font-weight: 600; font-size: 14px; padding: 10px 18px; border-radius: 50px; border: 1px solid rgba(212, 175, 55, 0.3); }
        nav a.active { background: linear-gradient(135deg, var(--crimson) 0%, #d32f2f 100%); color: #fff; border-color: var(--gold); }
        .nav-wsp { background: var(--wsp) !important; color: #fff !important; font-weight: 700 !important; }

        .container { max-width: 1240px; margin: 30px auto; padding: 0 24px; }
        .grid-2 { display: grid; grid-template-columns: 1.3fr 1fr; gap: 25px; margin-bottom: 25px; }
        @media (max-width: 860px) { .grid-2 { grid-template-columns: 1fr; } }

        .panel { background: var(--white); border-radius: 16px; padding: 26px; box-shadow: 0 10px 30px rgba(36, 21, 13, 0.08); border: 1px solid rgba(212, 175, 55, 0.35); margin-bottom: 24px; }
        .panel-title { font-family: 'Playfair Display', serif; font-size: 21px; margin: 0 0 16px 0; border-bottom: 2px solid #f2ebe1; padding-bottom: 10px; }

        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; }
        input, select { padding: 11px 14px; border: 1.5px solid #dfd5c8; border-radius: 10px; font-size: 14px; background: #fffdf9; }

        .payment-box {
            background: linear-gradient(135deg, #2d1436 0%, #1a0c20 100%);
            color: #fff; padding: 16px; border-radius: 12px; margin-top: 14px;
            border: 1.5px solid var(--gold); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;
        }

        .btn-gold { background: linear-gradient(135deg, #d4af37 0%, #f3d06b 100%); color: #1a0f07; border: none; padding: 11px 20px; border-radius: 10px; font-weight: 800; cursor: pointer; }
        .btn-crimson { background: linear-gradient(135deg, var(--crimson) 0%, #c62828 100%); color: #fff; border: none; padding: 14px; border-radius: 10px; font-weight: 800; width: 100%; font-size: 15px; cursor: pointer; margin-top: 14px; }
        .btn-wsp-order { background: var(--wsp); color: #fff; border: none; padding: 13px; border-radius: 10px; font-weight: 800; width: 100%; font-size: 15px; cursor: pointer; margin-top: 10px; }

        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #f0e6da; font-size: 14px; }
        th { background: var(--wood-mid); color: var(--gold-bright); font-size: 12px; text-transform: uppercase; }
        .badge-pay { background: #f3e5f5; color: #6a1b9a; padding: 4px 10px; border-radius: 12px; font-weight: 700; font-size: 12px; }
        .alerta { display: none; padding: 15px 20px; background: #1b5e20; color: #fff; border-left: 5px solid var(--gold); border-radius: 10px; margin-bottom: 20px; font-weight: 600; }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="brand">
        <img src="assets/img/logo.jpg" alt="El Rincón del Sabor" class="brand-logo" onerror="this.src='https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=200&q=80'">
        <div class="brand-text">
            <h1>El Rincón del Sabor <span class="v-badge">v6.0</span></h1>
            <span>Restaurante &amp; Tradición Peruana</span>
        </div>
    </a>
    <nav>
        <a href="index.php">🍽️ Carta Gourmet</a>
        <a href="pedidos.php" class="active">🧾 Pedidos y Pagos</a>
        <a href="reportes.php">📊 Reportes y Caja</a>
        <a href="https://wa.me/51968752081" target="_blank" class="nav-wsp">📲 WhatsApp: 968 752 081</a>
    </nav>
</header>

<div class="container">
    <div id="alerta-pedido" class="alerta"></div>

    <div class="grid-2">
        <div class="panel">
            <h3 class="panel-title">🧾 Registrar Comanda y Método de Pago</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:12px; margin-bottom:14px;">
                <div class="form-group">
                    <label>Mesa / Servicio</label>
                    <select id="mesa">
                        <option value="Mesa 01">Mesa 01</option>
                        <option value="Mesa 02">Mesa 02</option>
                        <option value="Mesa 03">Mesa 03</option>
                        <option value="Mesa 04 VIP">Mesa 04 VIP</option>
                        <option value="Delivery WhatsApp">Delivery WhatsApp</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Cliente</label>
                    <input type="text" id="cliente" placeholder="Nombre del cliente..." required>
                </div>
                <div class="form-group">
                    <label>💳 Método de Pago</label>
                    <select id="metodo_pago">
                        <option value="Yape (968752081)">📱 Yape (968 752 081)</option>
                        <option value="Plin (968752081)">📱 Plin (968 752 081)</option>
                        <option value="Efectivo">💵 Efectivo en Caja</option>
                        <option value="Tarjeta Visa/Mastercard">💳 Tarjeta POS</option>
                        <option value="Transferencia Bancaria">🏦 Transferencia</option>
                    </select>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 2fr 0.7fr auto; gap:10px; align-items:end; background:#faf5ed; padding:14px; border-radius:12px; border:1px dashed var(--gold);">
                <div class="form-group">
                    <label>Seleccionar Plato o Bebida</label>
                    <select id="select-plato"></select>
                </div>
                <div class="form-group">
                    <label>Cant.</label>
                    <input type="number" id="cantidad" value="1" min="1" max="50">
                </div>
                <button type="button" class="btn-gold" onclick="agregarAlCarrito()">+ Añadir</button>
            </div>

            <table>
                <thead><tr><th>Producto</th><th>Cant.</th><th>Subtotal</th><th></th></tr></thead>
                <tbody id="tabla-carrito"><tr><td colspan="4" style="text-align:center;">Sin productos en la comanda</td></tr></tbody>
            </table>

            <div class="payment-box">
                <div>
                    <div style="font-size:12px; color:#f9d976; font-weight:700;">NÚMERO OFICIAL YAPE / PLIN / WHATSAPP:</div>
                    <div style="font-size:18px; font-weight:800;">📲 968 752 081 — El Rincón del Sabor</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:11px; color:#ccc;">TOTAL A PAGAR</div>
                    <div id="total-pagar" style="font-size:24px; font-weight:800; color:var(--gold-bright);">S/ 0.00</div>
                </div>
            </div>

            <button type="button" class="btn-crimson" onclick="procesarPedido(false)">✅ Confirmar Pedido y Guardar en Caja</button>
            <button type="button" class="btn-wsp-order" onclick="procesarPedido(true)">📲 Guardar y Enviar Comanda por WhatsApp (968 752 081)</button>
        </div>

        <div class="panel">
            <h3 class="panel-title">🔥 Stock en Cocina</h3>
            <table>
                <thead><tr><th>Especialidad</th><th>Precio</th><th>Disponibles</th></tr></thead>
                <tbody id="tabla-stock"></tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <h3 class="panel-title">🕒 Historial de Comandas y Pagos</h3>
        <table>
            <thead><tr><th>Ticket</th><th>Mesa</th><th>Cliente</th><th>Método de Pago</th><th>Total</th><th>Fecha</th></tr></thead>
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
        tbodyStock.innerHTML += `<tr><td><strong>${p.nombre}</strong></td><td>S/ ${parseFloat(p.precio).toFixed(2)}</td><td>${p.stock} unid.</td></tr>`;
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
        if (existente.cantidad + cantidad > plato.stock) return alert('Stock insuficiente.');
        existente.cantidad += cantidad;
    } else {
        if (cantidad > plato.stock) return alert('Stock insuficiente.');
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
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;">Sin productos en la comanda</td></tr>';
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

async function procesarPedido(enviarWhatsApp) {
    const mesa = document.getElementById('mesa').value;
    const cliente = document.getElementById('cliente').value.trim();
    const metodo_pago = document.getElementById('metodo_pago').value;

    if (!cliente) return alert('Ingresa el nombre del cliente.');
    if (carrito.length === 0) return alert('Añade al menos un plato.');

    let total = 0;
    let detalleTexto = '';
    carrito.forEach(i => {
        const sub = i.precio * i.cantidad;
        total += sub;
        detalleTexto += `• ${i.cantidad}x ${i.nombre} (S/ ${sub.toFixed(2)})\n`;
    });

    const res = await fetch('controllers/pedidos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, cliente, metodo_pago, items: carrito })
    });
    const json = await res.json();

    if (json.status === 'success') {
        if (enviarWhatsApp) {
            const textoWsp = encodeURIComponent(
                `🍽️ *COMANDA #${json.idpedido} - EL RINCÓN DEL SABOR*\n` +
                `👤 *Cliente:* ${cliente}\n` +
                `📍 *Servicio:* ${mesa}\n` +
                `💳 *Pago:* ${metodo_pago}\n\n` +
                `*DETALLE DEL PEDIDO:*\n${detalleTexto}\n` +
                `💰 *TOTAL A PAGAR: S/ ${total.toFixed(2)}*`
            );
            window.open(`https://wa.me/51968752081?text=${textoWsp}`, '_blank');
        }

        const a = document.getElementById('alerta-pedido');
        a.textContent = `✅ ${json.message} — Inventario actualizado.`;
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
        tbody.innerHTML += `
            <tr>
                <td><strong>#${ped.idpedido}</strong></td>
                <td>${ped.mesa}</td>
                <td>${ped.cliente}</td>
                <td><span class="badge-pay">${ped.metodo_pago || 'Efectivo'}</span></td>
                <td><strong>S/ ${parseFloat(ped.total).toFixed(2)}</strong></td>
                <td>${ped.fecha}</td>
            </tr>
        `;
    });
}
cargarDatosIniciales();
</script>
</body>
</html>