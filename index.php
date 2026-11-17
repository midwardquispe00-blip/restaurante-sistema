<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Carta Gourmet y Gestión</title>
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
        <a href="index.php" class="active">🍽️ Carta Gourmet</a>
        <a href="pedidos.php">🧾 Pedidos en Salón</a>
        <a href="reportes.php">📊 Reportes y Caja</a>
    </nav>
</header>

<section class="hero-banner">
    <h2>Nuestra Carta de Especialidades</h2>
    <p>Tradición culinaria, ingredientes frescos y sazón artesanal en cada plato</p>
</section>

<div class="container">
    <div id="mensaje-alerta" class="alerta"></div>

    <!-- Formulario para agregar nuevos platos -->
    <div class="card">
        <h3 class="card-title">✨ Agregar Nueva Especialidad a la Carta</h3>
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
                    <input type="text" id="nombre" placeholder="Ej. Ceviche Mixto Especial" required>
                </div>
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="precio" step="0.10" min="0.50" placeholder="32.00" required>
                </div>
                <div class="form-group">
                    <label>Porciones Disponibles</label>
                    <input type="number" id="stock" min="1" value="25" required>
                </div>
            </div>
            <div class="form-group" style="margin-top: 14px;">
                <label>Descripción Gastronómica</label>
                <input type="text" id="descripcion" placeholder="Ingredientes, guarniciones y toque de la casa...">
            </div>
            <button type="submit" class="btn-gold" style="margin-top: 16px;">+ Publicar en la Carta</button>
        </form>
    </div>

    <!-- Buscador y Galería Visual de Platos -->
    <div class="card">
        <div class="card-title">
            <span>📖 Catálogo Visual de Platos</span>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <input type="text" id="buscador" placeholder="🔍 Buscar plato..." onkeyup="filtrarCarta()" style="width:220px;">
                <select id="filtro-categoria" onchange="filtrarCarta()">
                    <option value="">Todas las categorías</option>
                    <option value="Entradas">Entradas</option>
                    <option value="Platos de Fondo">Platos de Fondo</option>
                    <option value="Bebidas">Bebidas</option>
                </select>
            </div>
        </div>

        <div id="galeria-platos" class="menu-grid"></div>
    </div>
</div>

<!-- Modal de Edición -->
<div id="modal-editar" class="modal">
    <div class="modal-content">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h3 style="margin:0; font-family:'Playfair Display', serif;">✏️ Editar Especialidad</h3>
            <button onclick="cerrarModal()" style="background:none; border:none; font-size:22px; cursor:pointer;">&times;</button>
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
                    <label>Stock Disponible</label>
                    <input type="number" id="edit-stock" min="0" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:12px;">
                <label>Descripción</label>
                <input type="text" id="edit-descripcion">
            </div>
            <div class="form-group" style="margin-bottom:16px;">
                <label>Estado en Carta</label>
                <select id="edit-condicion">
                    <option value="1">Disponible en Salón</option>
                    <option value="0">Agotado / Oculto</option>
                </select>
            </div>
            <button type="submit" class="btn-crimson" style="width:100%;">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
let listaPlatos = [];

// Asignar fotografía gastronómica según el nombre o categoría del plato
function obtenerFotoPlato(plato) {
    const n = plato.nombre.toLowerCase();
    if (n.includes('lomo')) return 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=700&q=80';
    if (n.includes('trucha') || n.includes('pescado')) return 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&w=700&q=80';
    if (n.includes('ceviche') || n.includes('marisco')) return 'https://images.unsplash.com/photo-1535399831218-d5bd36d1a6b3?auto=format&fit=crop&w=700&q=80';
    if (n.includes('huanca') || n.includes('papa') || plato.categoria === 'Entradas') return 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=700&q=80';
    if (n.includes('chicha') || plato.categoria === 'Bebidas') return 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=700&q=80';
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
        grid.innerHTML = '<p style="text-align:center; grid-column:1/-1;">No hay platos que coincidan con tu búsqueda.</p>';
        return;
    }

    datos.forEach(p => {
        const foto = obtenerFotoPlato(p);
        const lowClass = p.stock <= 5 ? 'low' : '';
        const estadoTexto = p.condicion == 1 ? `${p.stock} porciones` : 'Agotado';

        grid.innerHTML += `
            <div class="dish-card" style="opacity: ${p.condicion == 1 ? '1' : '0.65'}">
                <div class="dish-img-wrap">
                    <img src="${foto}" alt="${p.nombre}">
                    <span class="dish-badge-cat">${p.categoria}</span>
                    <span class="dish-price-tag">S/ ${parseFloat(p.precio).toFixed(2)}</span>
                </div>
                <div class="dish-body">
                    <div>
                        <span class="dish-code">${p.codigo}</span>
                        <h4 class="dish-title">${p.nombre}</h4>
                        <p class="dish-desc">${p.descripcion || 'Especialidad preparada al momento por nuestros chefs.'}</p>
                    </div>
                    <div class="dish-footer">
                        <span class="stock-pill ${lowClass}">${estadoTexto}</span>
                        <button class="btn-card-edit" onclick="abrirModal(${p.idplato})">✏️ Editar</button>
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
        mostrarAlerta('✅ ¡Especialidad publicada en la carta de El Rincón del Sabor!');
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
        mostrarAlerta('✅ ¡Carta actualizada correctamente!');
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