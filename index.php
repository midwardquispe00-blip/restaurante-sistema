<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Carta Gourmet</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --wood-dark: #140c07;
            --wood-mid: #24150d;
            --gold: #d4af37;
            --gold-bright: #f9d976;
            --crimson: #a81c1c;
            --crimson-dark: #7d1111;
            --bg-cream: #f8f4ec;
            --white: #ffffff;
            --text-main: #2b1d14;
            --text-muted: #736154;
        }
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { margin: 0; background-color: var(--bg-cream); color: var(--text-main); }

        /* Barra Superior de Lujo */
        header {
            background: linear-gradient(90deg, #110905 0%, #2b170e 50%, #110905 100%);
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid var(--gold);
            box-shadow: 0 6px 25px rgba(0,0,0,0.45);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
        }
        .brand-logo {
            width: 68px !important;
            height: 68px !important;
            min-width: 68px;
            border-radius: 50%;
            border: 2.5px solid var(--gold);
            object-fit: cover;
            box-shadow: 0 0 18px rgba(212, 175, 55, 0.6);
            background: #140c07;
        }
        .brand-text h1 {
            font-family: 'Playfair Display', serif;
            margin: 0;
            font-size: 26px;
            background: linear-gradient(to right, #f9d976, #d4af37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 0.5px;
        }
        .brand-text span {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            color: #e6d7c3;
            display: block;
            margin-top: 2px;
        }

        nav { display: flex; gap: 12px; align-items: center; }
        nav a {
            color: #f3eae0;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 50px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            transition: all 0.25s ease;
        }
        nav a:hover {
            border-color: var(--gold-bright);
            color: var(--gold-bright);
            background: rgba(212, 175, 55, 0.1);
        }
        nav a.active {
            background: linear-gradient(135deg, var(--crimson) 0%, #d32f2f 100%);
            color: #fff;
            border-color: var(--gold);
            box-shadow: 0 4px 15px rgba(168, 28, 28, 0.5);
        }

        /* Banner Principal con Logo Destacado */
        .hero {
            background: linear-gradient(rgba(17, 9, 5, 0.78), rgba(17, 9, 5, 0.88)),
                        url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1400&q=80') center/cover;
            padding: 38px 20px;
            text-align: center;
            color: #fff;
            border-bottom: 2px solid var(--gold);
        }
        .hero h2 {
            font-family: 'Playfair Display', serif;
            font-size: 34px;
            margin: 0 0 8px 0;
            color: var(--gold-bright);
            text-shadow: 0 2px 10px rgba(0,0,0,0.6);
        }
        .hero p {
            margin: 0;
            font-size: 15px;
            color: #e0d4c8;
            max-width: 650px;
            margin-inline: auto;
        }

        .container { max-width: 1260px; margin: 32px auto; padding: 0 24px; }

        /* Tarjetas elegantes */
        .panel {
            background: var(--white);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(36, 21, 13, 0.08);
            margin-bottom: 30px;
            border: 1px solid rgba(212, 175, 55, 0.35);
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            border-bottom: 2px solid #f2ebe1;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }
        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            margin: 0;
            color: var(--wood-dark);
        }

        /* Formulario */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 16px;
        }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; color: var(--wood-mid); }
        input, select {
            padding: 11px 14px;
            border: 1.5px solid #dfd5c8;
            border-radius: 10px;
            font-size: 14px;
            background: #fffdf9;
            color: var(--text-main);
            outline: none;
            transition: 0.2s;
        }
        input:focus, select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f3d06b 100%);
            color: #1a0f07;
            border: none;
            padding: 12px 26px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-gold:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(212, 175, 55, 0.6); }

        /* Galería tipo Revista / Michelin (4 columnas) */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 24px;
        }
        .dish-card {
            background: var(--white);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.07);
            border: 1px solid #ece3d5;
            transition: transform 0.28s ease, box-shadow 0.28s ease;
            display: flex;
            flex-direction: column;
        }
        .dish-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 32px rgba(20, 12, 7, 0.16);
            border-color: var(--gold);
        }
        .dish-img-box {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #24150d;
        }
        .dish-img-box img {
            width: 100% !important;
            height: 200px !important;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .dish-card:hover .dish-img-box img { transform: scale(1.07); }

        .cat-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(20, 12, 7, 0.85);
            color: var(--gold-bright);
            border: 1px solid var(--gold);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            backdrop-filter: blur(4px);
        }
        .price-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: linear-gradient(135deg, var(--crimson) 0%, #c62828 100%);
            color: #fff;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.35);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .dish-content { padding: 18px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .dish-code { font-size: 11px; color: var(--text-muted); font-weight: 700; letter-spacing: 1px; }
        .dish-name { font-family: 'Playfair Display', serif; font-size: 20px; margin: 4px 0 8px 0; color: var(--wood-dark); }
        .dish-desc { font-size: 13px; color: var(--text-muted); line-height: 1.5; margin: 0 0 16px 0; }
        .dish-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #f2ebe1;
        }
        .stock-badge {
            background: #e8f5e9;
            color: #1b5e20;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .stock-badge.low { background: #ffebee; color: #b71c1c; }

        .btn-edit-card {
            background: var(--wood-mid);
            color: var(--gold-bright);
            border: 1px solid var(--gold);
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-edit-card:hover { background: var(--gold); color: var(--wood-dark); }

        .alerta {
            display: none;
            padding: 15px 20px;
            background: #1b5e20;
            color: #fff;
            border-left: 5px solid var(--gold);
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 8, 4, 0.75);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
        .modal-box {
            background: #fff;
            padding: 28px;
            border-radius: 16px;
            width: 480px;
            max-width: 92%;
            border: 2px solid var(--gold);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }
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
        <a href="index.php" class="active">🍽️ Carta Gourmet</a>
        <a href="pedidos.php">🧾 Pedidos en Salón</a>
        <a href="reportes.php">📊 Reportes y Caja</a>
    </nav>
</header>

<section class="hero">
    <h2>Nuestra Carta de Especialidades</h2>
    <p>Seleccionamos los mejores ingredientes frescos para brindarte una experiencia gastronómica inolvidable</p>
</section>

<div class="container">
    <div id="mensaje-alerta" class="alerta"></div>

    <!-- Formulario para añadir plato -->
    <div class="panel">
        <div class="panel-header">
            <h3 class="panel-title">✨ Registrar Nueva Especialidad en la Carta</h3>
        </div>
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
                    <label>Código</label>
                    <input type="text" id="codigo" placeholder="Ej. PLT-003" required>
                </div>
                <div class="form-group">
                    <label>Nombre del Plato</label>
                    <input type="text" id="nombre" placeholder="Ej. Ceviche Clásico" required>
                </div>
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="precio" step="0.10" min="0.50" placeholder="30.00" required>
                </div>
                <div class="form-group">
                    <label>Porciones Disponibles</label>
                    <input type="number" id="stock" min="1" value="30" required>
                </div>
            </div>
            <div class="form-group" style="margin-top: 14px;">
                <label>Descripción Gastronómica</label>
                <input type="text" id="descripcion" placeholder="Describe los ingredientes y acompañamiento del plato...">
            </div>
            <button type="submit" class="btn-gold" style="margin-top: 18px;">+ Publicar Plato en la Carta</button>
        </form>
    </div>

    <!-- Galería Visual de Platos -->
    <div class="panel">
        <div class="panel-header">
            <h3 class="panel-title">📖 Catálogo Gastronómico</h3>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <input type="text" id="buscador" placeholder="🔍 Buscar especialidad..." onkeyup="filtrarCarta()" style="width:230px;">
                <select id="filtro-categoria" onchange="filtrarCarta()">
                    <option value="">Todas las categorías</option>
                    <option value="Entradas">Entradas</option>
                    <option value="Platos de Fondo">Platos de Fondo</option>
                    <option value="Bebidas">Bebidas</option>
                </select>
            </div>
        </div>

        <div id="galeria-platos" class="catalog-grid"></div>
    </div>
</div>

<!-- Modal Editar -->
<div id="modal-editar" class="modal">
    <div class="modal-box">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
            <h3 style="margin:0; font-family:'Playfair Display', serif; font-size:22px;">✏️ Editar Especialidad</h3>
            <button onclick="cerrarModal()" style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
        </div>
        <form id="form-editar">
            <input type="hidden" id="edit-id">
            <div class="form-group" style="margin-bottom:12px;">
                <label>Categoría</label>
                <select id="edit-categoria">
                    <option value="1">Entradas</option>
                    <option value="2">Platos de Fondo</option>
                    <option value="3">Bebidas</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:12px;">
                <label>Nombre del Plato</label>
                <input type="text" id="edit-nombre" required>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="edit-precio" step="0.10" required>
                </div>
                <div class="form-group">
                    <label>Porciones en Stock</label>
                    <input type="number" id="edit-stock" min="0" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:12px;">
                <label>Descripción</label>
                <input type="text" id="edit-descripcion">
            </div>
            <div class="form-group" style="margin-bottom:18px;">
                <label>Disponibilidad</label>
                <select id="edit-condicion">
                    <option value="1">Disponible en Salón</option>
                    <option value="0">Agotado / Oculto</option>
                </select>
            </div>
            <button type="submit" class="btn-gold" style="width:100%;">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
let listaPlatos = [];

function obtenerFotoPlato(plato) {
    const n = plato.nombre.toLowerCase();
    if (n.includes('lomo')) return 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=700&q=80';
    if (n.includes('trucha') || n.includes('pescado')) return 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&w=700&q=80';
    if (n.includes('ceviche') || n.includes('marisco')) return 'https://images.unsplash.com/photo-1535399831218-d5bd36d1a6b3?auto=format&fit=crop&w=700&q=80';
    if (n.includes('papa') || n.includes('huanca') || plato.categoria === 'Entradas') return 'https://images.unsplash.com/photo-1541529086526-db283c563270?auto=format&fit=crop&w=700&q=80';
    if (n.includes('chicha') || plato.categoria === 'Bebidas') return 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=700&q=80';
    if (n.includes('arroz') || n.includes('pollo')) return 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=700&q=80';
    return 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=700&q=80';
}

async function cargarCarta() {
    const res = await fetch('controllers/carta.php');
    const json = await res.json();
    listaPlatos = json.data || [];
    renderizarGaleria(listaPlatos);
}

function renderizarGaleria(datos) {
    const grid = document.getElementById('galeria-platos');
    grid.innerHTML = '';

    if (datos.length === 0) {
        grid.innerHTML = '<p style="text-align:center; grid-column:1/-1; color:#736154;">No se encontraron especialidades.</p>';
        return;
    }

    datos.forEach(p => {
        const foto = obtenerFotoPlato(p);
        const lowClass = p.stock <= 5 ? 'low' : '';
        const textoStock = p.condicion == 1 ? `🔥 ${p.stock} disponibles` : '⛔ Agotado';

        grid.innerHTML += `
            <div class="dish-card" style="opacity: ${p.condicion == 1 ? '1' : '0.6'}">
                <div class="dish-img-box">
                    <img src="${foto}" alt="${p.nombre}">
                    <span class="cat-tag">${p.categoria}</span>
                    <span class="price-badge">S/ ${parseFloat(p.precio).toFixed(2)}</span>
                </div>
                <div class="dish-content">
                    <div>
                        <span class="dish-code">${p.codigo}</span>
                        <h4 class="dish-name">${p.nombre}</h4>
                        <p class="dish-desc">${p.descripcion || 'Especialidad de la casa preparada al instante.'}</p>
                    </div>
                    <div class="dish-bottom">
                        <span class="stock-badge ${lowClass}">${textoStock}</span>
                        <button class="btn-edit-card" onclick="abrirModal(${p.idplato})">✏️ Editar</button>
                    </div>
                </div>
            </div>
        `;
    });
}

function filtrarCarta() {
    const texto = document.getElementById('buscador').value.toLowerCase();
    const cat = document.getElementById('filtro-categoria').value;
    const filtrados = listaPlatos.filter(p => {
        return (p.nombre.toLowerCase().includes(texto) || p.codigo.toLowerCase().includes(texto)) &&
               (cat === '' || p.categoria === cat);
    });
    renderizarGaleria(filtrados);
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
        mostrarAlerta('✅ ¡Especialidad agregada exitosamente a El Rincón del Sabor!');
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

function cerrarModal() { document.getElementById('modal-editar').style.display = 'none'; }

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
        mostrarAlerta('✅ ¡Plato actualizado correctamente!');
        cargarCarta();
    }
});

function mostrarAlerta(msg) {
    const a = document.getElementById('mensaje-alerta');
    a.textContent = msg;
    a.style.display = 'block';
    setTimeout(() => a.style.display = 'none', 3500);
}

cargarCarta();
</script>
</body>
</html>