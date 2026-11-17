<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoVentas | Pedidos en Salón</title>
    <style>
        :root {
            --primary: #e65100;
            --primary-hover: #bf360c;
            --secondary: #27ae60;
            --secondary-hover: #219150;
            --dark: #1e272e;
            --light-bg: #f4f6f9;
            --card-bg: #ffffff;
            --text: #2f3640;
            --border: #dcdde1;
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
        header .version-tag { background: var(--primary); font-size: 12px; padding: 4px 10px; border-radius: 20px; font-weight: bold; }
        nav a { color: #dcdde1; text-decoration: none; margin-left: 20px; font-weight: 600; padding: 8px 14px; border-radius: 6px; transition: 0.2s; }
        nav a.active, nav a:hover { background: var(--primary); color: #fff; }

        .container { max-width: 1150px; margin: 30px auto; padding: 0 20px; }
        .grid-layout { display: grid; grid-template-columns: 1.2fr 1fr; gap: 25px; margin-bottom: 25px; }
        @media (max-width: 850px) { .grid-layout { grid-template-columns: 1fr; } }

        .card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            border-top: 4px solid var(--secondary);
        }
        .card h2 { margin-top: 0; font-size: 18px; color: var(--dark); border-bottom: 1px solid #eee; padding-bottom: 10px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #57606f; }
        input, select {
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }
        input:focus, select:focus { border-color: var(--secondary); }

        .add-item-box {
            display: grid;
            grid-template-columns: 2fr 0.8fr auto;
            gap: 10px;
            align-items: end;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px dashed #ced6e0;
        }

        button {
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
        }
        .btn-add { background: var(--dark); color: #fff; height: 40px; }
        .btn-add:hover { background: #353b48; }
        .btn-confirm { background: var(--secondary); color: #fff; width: 100%; padding: 14px; font-size: 16px; margin-top: 15px; }
        .btn-confirm:hover { background: var(--secondary-hover); }
        .btn-del { background: #ff4757; color: #fff; padding: 4px 10px; font-size: 12px; border-radius: 4px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px 10px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f8f9fa; color: #2f3640; font-weight: 700; font-size: 12px; text-transform: uppercase; }

        .total-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #1b5e20;
        }
        .badge-estado { background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .alerta {
            display: none;
            padding: 12px 16px;
            background: #d4edda;
            color: #155724;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<header>
    <h1>🍽️ RestoVentas <span class="version-tag">v3.0</span></h1>
    <nav>
        <a href="index.php">Gestión de Carta</a>
        <a href="pedidos.php" class="active">Pedidos en Salón</a>
    </nav>
</header>

<div class="container">
    <div id="alerta-pedido" class="alerta"></div>

    <div class="grid-layout">
        <!-- Columna Izquierda: Armar Comanda -->
        <div class="card">
            <h2>🧾 Nueva Comanda por Mesa</h2>
            <div class="form-row">
                <div class="form-group">
                    <label>Mesa / Ubicación</label>
                    <select id="mesa">
                        <option value="Mesa 01">Mesa 01</option>
                        <option value="Mesa 02">Mesa 02</option>
                        <option value="Mesa 03">Mesa 03</option>
                        <option value="Mesa 04">Mesa 04</option>
                        <option value="Mesa 05">Mesa 05</option>
                        <option value="Para Llevar">Para Llevar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nombre del Cliente</label>
                    <input type="text" id="cliente" placeholder="Ej. Carlos Mendoza" required>
                </div>
            </div>

            <div class="add-item-box">
                <div class="form-group">
                    <label>Seleccionar Plato de la Carta</label>
                    <select id="select-plato"></select>
                </div>
                <div class="form-group">
                    <label>Cantidad</label>
                    <input type="number" id="cantidad" value="1" min="1" max="50">
                </div>
                <button type="button" class="btn-add" onclick="agregarAlCarrito()">+ Añadir</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Plato</th>
                        <th>Cant.</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tabla-carrito">
                    <tr><td colspan="4" style="text-align:center; color:#888;">Aún no hay platos en la comanda</td></tr>
                </tbody>
            </table>

            <div class="total-box">
                <span>TOTAL A PAGAR:</span>
                <span id="total-pagar">S/ 0.00</span>
            </div>

            <button type="button" class="btn-confirm" onclick="procesarPedido()">✅ Confirmar y Registrar Pedido</button>
        </div>

        <!-- Columna Derecha: Resumen rápido de disponibilidad -->
        <div class="card" style="border-top-color: #e65100;">
            <h2>🔥 Disponibilidad en Cocina</h2>
            <p style="font-size: 13px; color: #666;">El stock se descuenta automáticamente al registrar cada comanda.</p>
            <table>
                <thead>
                    <tr>
                        <th>Plato</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody id="tabla-stock"></tbody>
            </table>
        </div>
    </div>

    <!-- Historial inferior de pedidos -->
    <div class="card" style="border-top-color: #1e272e;">
        <h2>🕒 Historial de Pedidos Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>N° Pedido</th>
                    <th>Mesa</th>
                    <th>Cliente</th>
                    <th>Platos</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
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
    select.innerHTML = '';
    tbodyStock.innerHTML = '';

    catalogoPlatos.forEach(p => {
        if (p.stock > 0 && p.condicion == 1) {
            select.innerHTML += `<option value="${p.idplato}">${p.nombre} (S/ ${parseFloat(p.precio).toFixed(2)})</option>`;
        }
        tbodyStock.innerHTML += `
            <tr>
                <td><strong>${p.nombre}</strong></td>
                <td>S/ ${parseFloat(p.precio).toFixed(2)}</td>
                <td>${p.stock} unid.</td>
            </tr>
        `;
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
        if (existente.cantidad + cantidad > plato.stock) {
            alert('Stock insuficiente en cocina para agregar esa cantidad.');
            return;
        }
        existente.cantidad += cantidad;
    } else {
        if (cantidad > plato.stock) {
            alert('Stock insuficiente en cocina.');
            return;
        }
        carrito.push({
            idplato: plato.idplato,
            nombre: plato.nombre,
            precio: parseFloat(plato.precio),
            cantidad: cantidad
        });
    }

    document.getElementById('cantidad').value = 1;
    renderizarCarrito();
}

function quitarDelCarrito(index) {
    carrito.splice(index, 1);
    renderizarCarrito();
}

function renderizarCarrito() {
    const tbody = document.getElementById('tabla-carrito');
    tbody.innerHTML = '';
    let total = 0;

    if (carrito.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; color:#888;">Aún no hay platos en la comanda</td></tr>';
        document.getElementById('total-pagar').textContent = 'S/ 0.00';
        return;
    }

    carrito.forEach((item, index) => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;
        tbody.innerHTML += `
            <tr>
                <td>${item.nombre}</td>
                <td>${item.cantidad}</td>
                <td><strong>S/ ${subtotal.toFixed(2)}</strong></td>
                <td><button type="button" class="btn-del" onclick="quitarDelCarrito(${index})">X</button></td>
            </tr>
        `;
    });

    document.getElementById('total-pagar').textContent = `S/ ${total.toFixed(2)}`;
}

async function procesarPedido() {
    const mesa = document.getElementById('mesa').value;
    const cliente = document.getElementById('cliente').value.trim();

    if (!cliente) {
        alert('Por favor ingresa el nombre del cliente.');
        return;
    }
    if (carrito.length === 0) {
        alert('Agrega al menos un plato a la comanda.');
        return;
    }

    const respuesta = await fetch('controllers/pedidos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, cliente, items: carrito })
    });

    const resultado = await respuesta.json();
    if (resultado.status === 'success') {
        const alerta = document.getElementById('alerta-pedido');
        alerta.textContent = `✅ ${resultado.message} — Stock actualizado en cocina.`;
        alerta.style.display = 'block';
        setTimeout(() => alerta.style.display = 'none', 4000);

        carrito = [];
        document.getElementById('cliente').value = '';
        renderizarCarrito();
        cargarDatosIniciales();
    } else {
        alert('Error al procesar el pedido: ' + resultado.message);
    }
}

async function cargarHistorialPedidos() {
    const res = await fetch('controllers/pedidos.php');
    const json = await res.json();
    const tbody = document.getElementById('tabla-historial');
    tbody.innerHTML = '';

    if (json.status === 'success' && json.data.length > 0) {
        json.data.forEach(ped => {
            tbody.innerHTML += `
                <tr>
                    <td><strong>#${ped.idpedido}</strong></td>
                    <td>${ped.mesa}</td>
                    <td>${ped.cliente}</td>
                    <td>${ped.cantidad_items} plato(s)</td>
                    <td><strong>S/ ${parseFloat(ped.total).toFixed(2)}</strong></td>
                    <td><span class="badge-estado">${ped.estado}</span></td>
                    <td>${ped.fecha}</td>
                </tr>
            `;
        });
    } else {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;">No hay pedidos registrados aún.</td></tr>';
    }
}

cargarDatosIniciales();
</script>

</body>
</html>