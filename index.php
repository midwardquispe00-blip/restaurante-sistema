<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoVentas | Gestión de Carta y Menú</title>
    <style>
        :root {
            --primary: #e65100;
            --primary-hover: #bf360c;
            --dark: #1e272e;
            --light-bg: #f4f6f9;
            --card-bg: #ffffff;
            --text: #2f3640;
            --border: #dcdde1;
            --success: #2ed573;
        }
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { margin: 0; background-color: var(--light-bg); color: var(--text); }
        
        /* Barra superior de navegación */
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

        /* Contenedor principal */
        .container { max-width: 1150px; margin: 30px auto; padding: 0 20px; }

        /* Tarjeta de formulario */
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
            transition: border 0.2s;
        }
        input:focus, select:focus { border-color: var(--primary); }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            margin-top: 15px;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: var(--primary-hover); }

        /* Tabla de platos */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 14px 12px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f8f9fa; color: #2f3640; font-weight: 700; text-transform: uppercase; font-size: 12px; }
        tr:hover { background-color: #fcfcfc; }

        .badge-cat { background: #e1f5fe; color: #0277bd; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-stock { background: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
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
    </style>
</head>
<body>

<header>
    <h1>🍽️ RestoVentas <span class="version-tag">v2.0</span></h1>
    <nav>
        <a href="index.php" class="active">Gestión de Carta</a>
        <a href="pedidos.php">Pedidos en Salón</a>
    </nav>
</header>

<div class="container">
    <div id="mensaje-alerta" class="alerta"></div>

    <!-- Formulario de registro de platos -->
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
                    <input type="text" id="nombre" placeholder="Ej. Ceviche Mixto" required>
                </div>
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="precio" step="0.10" min="0.50" placeholder="25.00" required>
                </div>
                <div class="form-group">
                    <label>Stock Disponible</label>
                    <input type="number" id="stock" min="1" value="30" required>
                </div>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Descripción / Ingredientes</label>
                <input type="text" id="descripcion" placeholder="Descripción breve del plato para los clientes...">
            </div>
            <button type="submit" class="btn-primary">Guardar Plato en la Carta</button>
        </form>
    </div>

    <!-- Listado visual de la carta -->
    <div class="card">
        <h2>📋 Carta Actual del Restaurante</h2>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Plato</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody id="tabla-carta">
                <tr><td colspan="6" style="text-align:center;">Cargando platos...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
// Cargar todos los platos desde controllers/carta.php
async function cargarCarta() {
    const respuesta = await fetch('controllers/carta.php');
    const resultado = await respuesta.json();
    const tbody = document.getElementById('tabla-carta');
    tbody.innerHTML = '';

    if (resultado.status === 'success' && resultado.data.length > 0) {
        resultado.data.forEach(plato => {
            tbody.innerHTML += `
                <tr>
                    <td><strong>${plato.codigo}</strong></td>
                    <td><span class="badge-cat">${plato.categoria}</span></td>
                    <td><strong>${plato.nombre}</strong></td>
                    <td>${plato.descripcion || 'Sin descripción'}</td>
                    <td><span class="badge-stock">${plato.stock} unid.</span></td>
                    <td class="precio">S/ ${parseFloat(plato.precio).toFixed(2)}</td>
                </tr>
            `;
        });
    } else {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">No hay platos registrados.</td></tr>';
    }
}

// Enviar nuevo plato al controlador sin recargar la página
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

    const respuesta = await fetch('controllers/carta.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datos)
    });

    const resultado = await respuesta.json();
    if (resultado.status === 'success') {
        const alerta = document.getElementById('mensaje-alerta');
        alerta.textContent = '✅ ¡Plato agregado correctamente a la carta!';
        alerta.style.display = 'block';
        setTimeout(() => alerta.style.display = 'none', 3500);

        document.getElementById('form-plato').reset();
        cargarCarta();
    }
});

// Iniciar carga al abrir la página
cargarCarta();
</script>

</body>
</html>