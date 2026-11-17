<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Pedidos en Salón</title>
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
        <a href="pedidos.php" class="active">🧾 Pedidos en Salón</a>
        <a href="reportes.php">📊 Reportes y Caja</a>
    </nav>
</header>

<div class="container">
    <div id="alerta-pedido" class="alerta"></div>

    <div style="display:grid; grid-template-columns: 1.25fr 1fr; gap:24px;">
        <div class="card">
            <h3 class="card-title">🧾 Nueva Comanda en Salón</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:14px; margin-bottom:14px;">
                <div class="form-group">
                    <label>Mesa / Servicio</label>
                    <select id="mesa">
                        <option value="Mesa 01">Mesa 01 - Salón Principal</option>
                        <option value="Mesa 02">Mesa 02 - Salón Principal</option>
                        <option value="Mesa 03">Mesa 03 - Terraza</option>
                        <option value="Mesa 04">Mesa 04 - VIP</option>
                        <option value="Para Llevar">Para Llevar / Delivery</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nombre del Comensal</label>
                    <input type="text" id="cliente" placeholder="Nombre del cliente..." required>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 2fr 0.7fr auto; gap:10px; align-items:end; background:#faf5ee; padding:14px; border-radius:10px; border:1px dashed var(--gold);">
                <div class="form-group">
                    <label>Elegir Especialidad</label>
                    <select id="select-plato"></select>
                </div>
                <div class="form-group">
                    <label>Cant.</label>
                    <input type="number" id="cantidad" value="1" min="1" max="50">
                </div>
                <button type="button" class="btn-gold" onclick="agregarAlCarrito()">+ Añadir</button>
            </div>

            <table style="margin-top:16px;">
                <thead><tr><th>Plato</th><th>Cant.</th><th>Subtotal</th><th></th></tr></thead>
                <tbody id="tabla-carrito"><tr><td colspan="4" style="text-align:center;">Comanda vacía</td></tr></tbody>
            </table>

            <div style="display:flex; justify-content:space-between; align-items:center; background:#261911; color:#f3d06b; padding:16px 20px; border-radius:10px; margin-top:16px; font-size:20px; font-weight:800;">
                <span>TOTAL COMANDA:</span>
                <span id="total-pagar">S/ 0.00</span>
            </div>

            <button type="button" class="btn-crimson" style="width:100%; margin-top:14px; padding:14px; font-size:16px;" onclick="procesarPedido()">✅ Enviar Comanda a Cocina</button>
        </div>

        <div class="card">
            <h3 class="card-title">🔥 Stock Disponible en Cocina</h3>
            <table>
                <thead><tr><th>Especialidad</th><th>Precio</th><th>Porciones</th></tr></thead>
                <tbody id="tabla-stock"></tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title">🕒 Historial de Comandas Atendidas</h3>
        <table>
            <thead><tr><th>Ticket</th><th>Mesa</th><th>Cliente</th><th>Platos</th><th>Total</th><th>Estado</th><th>Fecha</th></tr></thead>
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
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;">Comanda vacía</td></tr>';
        document.getElementById('total-pagar').textContent = 'S/ 0.00';
        return;
    }
    carrito.forEach((item, i) => {
        const sub = item.precio * item.cantidad;
        total += sub;
        tbody.innerHTML += `<tr><td>${item.nombre}</td><td>${item.cantidad}</td><td><strong>S/ ${sub.toFixed(2)}</strong></td><td><button onclick="quitarDelCarrito(${i})" style="background:#9e1b1b; color:#fff; border:none; border-radius:4px; padding:4px 8px; cursor:pointer;">X</button></td></tr>`;
    });
    document.getElementById('total-pagar').textContent = `S/ ${total.toFixed(2)}`;
}

async function procesarPedido() {
    const mesa = document.getElementById('mesa').value;
    const cliente = document.getElementById('cliente').value.trim();
    if (!cliente) return alert('Ingresa el nombre del comensal.');
    if (carrito.length === 0) return alert('Añade platos a la comanda.');

    const res = await fetch('controllers/pedidos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, cliente, items: carrito })
    });
    const json = await res.json();
    if (json.status === 'success') {
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
        tbody.innerHTML += `<tr><td><strong>#${ped.idpedido}</strong></td><td>${ped.mesa}</td><td>${ped.cliente}</td><td>${ped.cantidad_items}</td><td><strong>S/ ${parseFloat(ped.total).toFixed(2)}</strong></td><td>${ped.estado}</td><td>${ped.fecha}</td></tr>`;
    });
}
cargarDatosIniciales();
</script>
</body>
</html>