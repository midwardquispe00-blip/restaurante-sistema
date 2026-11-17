<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoVentas | Administración Avanzada de Carta</title>
    <style>
        :root {
            --primary: #e65100;
            --primary-hover: #bf360c;
            --dark: #1e272e;
            --light-bg: #f4f6f9;
            --card-bg: #ffffff;
            --text: #2f3640;
            --border: #dcdde1;
            --info: #0984e3;
            --danger: #d63031;
            --success: #00b894;
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

        .container { max-width: 1180px; margin: 30px auto; padding: 0 20px; }
        .card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            margin-bottom: 25px;
            border-top: 4px solid var(--primary);
        }
        .card h2 { margin-top: 0; font-size: 18px; color: var(--dark); border-bottom: 1px solid #eee; padding-bottom: 10px; }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #57606f; }
        input, select {
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }
        input:focus, select:focus { border-color: var(--primary); }

        .btn-primary { background: var(--primary); color: #fff; border: none; padding: 12px 20px; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 14px; margin-top: 15px; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-edit { background: var(--info); color: #fff; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer; font-size: 12px; font-weight: 600; }
        .btn-edit:hover { opacity: 0.9; }

        /* Barra de filtros */
        .filter-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        .filter-bar input { flex: 2; min-width: 220px; }
        .filter-bar select { flex: 1; min-width: 180px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 13px 12px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f8f9fa; color: #2f3640; font-weight: 700; text-transform: uppercase; font-size: 12px; }
        tr:hover { background-color: #fcfcfc; }

        .badge-cat { background: #e1f5fe; color: #0277bd; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-stock { background: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-low { background: #ffebee; color: #c62828; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-active { background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-inactive { background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .precio { font-weight: 700; color: var(--primary); font-size: 15px; }

        .alerta {
            display: none;
            padding: 12px 16px;
            background: #d4edda;
            color: #155724;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Ventana Modal de Edición */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            width: 480px;
            max-width: 92%;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        }
        .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; }
        .close-btn { background: none; border: none; font-size: 20px; cursor: pointer; color: #666; }
    </style>
</head>
<body>

<header>
    <h1>🍽️ RestoVentas <span class="version-tag">v4.0</span></h1>
    <nav>
        <a href="index.php" class="active">Gestión de Carta</a>
        <a href="pedidos.php">Pedidos en Salón</a>
    </nav>
</header>

<div class="container">
    <div id="mensaje-alerta" class="alerta"></div>

    <!-- Formulario de registro -->
    <div class="card">
        <h2>➕ Registrar Nuevo Plato en el Menú</h2>
        <form id="form-plato">
            <div class="form-grid">
                <div class="form-group">
                    <label>Categoría</label>
                    <select id="idcategoria" required>
                        <option value="1">Entradas</option>
                        <option value="2" selected>Platos de Fondo</option>
                        <option value="3">Bebidas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Código del Plato</label>
                    <input type="text" id="codigo" placeholder="Ej. PLT-003" required>
                </div>
                <div class="form-group">
                    <label>Nombre del Plato</label>
                    <input type="text" id="nombre" placeholder="Ej. Arroz con Pollo" required>
                </div>
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="precio" step="0.10" min="0.50" placeholder="22.00" required>
                </div>
                <div class="form-group">
                    <label>Stock Inicial</label>
                    <input type="number" id="stock" min="1" value="30" required>
                </div>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Descripción / Ingredientes</label>
                <input type="text" id="descripcion" placeholder="Descripción breve del plato...">
            </div>
            <button type="submit" class="btn-primary">Guardar Plato en la Carta</button>
        </form>
    </div>

    <!-- Tabla con Buscador y Filtro -->
    <div class="card">
        <h2>📋 Carta del Restaurante (Búsqueda y Edición)</h2>
        <div class="filter-bar">
            <input type="text" id="buscador" placeholder="🔍 Buscar plato por nombre o código..." onkeyup="filtrarTabla()">
            <select id="filtro-categoria" onchange="filtrarTabla()">
                <option value="">Todas las categorías</option>
                <option value="Entradas">Entradas</option>
                <option value="Platos de Fondo">Platos de Fondo</option>
                <option value="Bebidas">Bebidas</option>
            </select>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Plato</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-carta"></tbody>
        </table>
    </div>
</div>

<!-- Modal para Editar Plato -->
<div id="modal-editar" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0;">✏️ Editar Plato</h3>
            <button class="close-btn" onclick="cerrarModal()">&times;</button>
        </div>
        <form id="form-editar">
            <input type="hidden" id="edit-id">
            <div class="form-group" style="margin-bottom: 12px;">
                <label>Categoría</label>
                <select id="edit-categoria">
                    <option value="1">Entradas</option>
                    <option value="2">Platos de Fondo</option>
                    <option value="3">Bebidas</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 12px;">
                <label>Nombre del Plato</label>
                <input type="text" id="edit-nombre" required>
            </div>
            <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:12px;">
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="edit-precio" step="0.10" required>
                </div>
                <div class="form-group">
                    <label>Stock Disponible</label>
                    <input type="number" id="edit-stock" min="0" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 12px;">
                <label>Descripción</label>
                <input type="text" id="edit-descripcion">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Disponibilidad en Carta</label>
                <select id="edit-condicion">
                    <option value="1">Activo (Disponible para pedidos)</option>
                    <option value="0">Agotado / Oculto</option>
                </select>
            </div>
            <button type="submit" class="btn-primary" style="width:100%; margin-top:0;">Actualizar Cambios</button>
        </form>
    </div>
</div>

<script>
let listaPlatos = [];

async function cargarCarta() {
    const res = await fetch('controllers/carta.php');
    const json = await res.json();
    listaPlatos = json.data || [];
    renderizarTabla(listaPlatos);
}

function renderizarTabla(datos) {
    const tbody = document.getElementById('tabla-carta');
    tbody.innerHTML = '';

    if (datos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;">No se encontraron platos.</td></tr>';
        return;
    }

    datos.forEach(p => {
        const badgeStock = p.stock <= 5 ? 'badge-low' : 'badge-stock';
        const estadoBadge = p.condicion == 1
            ? '<span class="badge-active">Disponible</span>'
            : '<span class="badge-inactive">No Disponible</span>';

        tbody.innerHTML += `
            <tr>
                <td><strong>${p.codigo}</strong></td>
                <td><span class="badge-cat">${p.categoria}</span></td>
                <td>
                    <strong>${p.nombre}</strong><br>
                    <small style="color:#7f8c8d;">${p.descripcion || ''}</small>
                </td>
                <td><span class="${badgeStock}">${p.stock} unid.</span></td>
                <td class="precio">S/ ${parseFloat(p.precio).toFixed(2)}</td>
                <td>${estadoBadge}</td>
                <td><button class="btn-edit" onclick="abrirModal(${p.idplato})">Editar</button></td>
            </tr>
        `;
    });
}

function filtrarTabla() {
    const texto = document.getElementById('buscador').value.toLowerCase();
    const cat = document.getElementById('filtro-categoria').value;

    const filtrados = listaPlatos.filter(p => {
        const coincideTexto = p.nombre.toLowerCase().includes(texto) || p.codigo.toLowerCase().includes(texto);
        const coincideCat = cat === '' || p.categoria === cat;
        return coincideTexto && coincideCat;
    });
    renderizarTabla(filtrados);
}

document.getElementById('form-plato').addEventListener('submit', async function(e) {
    e.preventDefault();
    const datos = {
        idcategoria: document.getElementById('idcategoria').value,
        codigo: document.getElementById('codigo').value.trim(),
        nombre: document.getElementById('nombre').value.trim(),
        precio: parseFloat(document.getElementById('precio').value),
        stock: parseInt(document.getElementById('stock').value),
        descripcion: document.getElementById('descripcion').value.trim()
    };

    const res = await fetch('controllers/carta.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datos)
    });
    const json = await res.json();
    if (json.status === 'success') {
        mostrarAlerta('✅ ¡Plato agregado a la carta!');
        document.getElementById('form-plato').reset();
        cargarCarta();
    }
});

function abrirModal(id) {
    const p = listaPlatos.find(item => item.idplato == id);
    if (!p) return;
    document.getElementById('edit-id').value = p.idplato;
    document.getElementById('edit-categoria').value = p.idcategoria;
    document.getElementById('edit-nombre').value = p.nombre;
    document.getElementById('edit-precio').value = p.precio;
    document.getElementById('edit-stock').value = p.stock;
    document.getElementById('edit-descripcion').value = p.descripcion;
    document.getElementById('edit-condicion').value = p.condicion;
    document.getElementById('modal-editar').style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modal-editar').style.display = 'none';
}

document.getElementById('form-editar').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('edit-id').value;
    const datos = {
        idcategoria: document.getElementById('edit-categoria').value,
        nombre: document.getElementById('edit-nombre').value.trim(),
        precio: parseFloat(document.getElementById('edit-precio').value),
        stock: parseInt(document.getElementById('edit-stock').value),
        descripcion: document.getElementById('edit-descripcion').value.trim(),
        condicion: parseInt(document.getElementById('edit-condicion').value)
    };

    const res = await fetch(`controllers/carta.php?id=${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datos)
    });
    const json = await res.json();
    if (json.status === 'success') {
        cerrarModal();
        mostrarAlerta('✅ ¡Datos del plato actualizados correctamente!');
        cargarCarta();
    }
});

function mostrarAlerta(msg) {
    const alerta = document.getElementById('mensaje-alerta');
    alerta.textContent = msg;
    alerta.style.display = 'block';
    setTimeout(() => alerta.style.display = 'none', 3500);
}

cargarCarta();
</script>

</body>
</html>