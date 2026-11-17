<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Carta Gourmet v6.0</title>
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
            --text-muted: #736154;
            --wsp: #25D366;
            --yape: #742284;
            --plin: #00b4d8;
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
            position: sticky;
            top: 0;
            z-index: 999;
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
            font-size: 25px;
            background: linear-gradient(to right, #f9d976, #d4af37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand-text span { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #e6d7c3; display: block; }
        .v-badge { background: var(--gold); color: #140c07; padding: 2px 8px; border-radius: 12px; font-weight: 800; font-size: 11px; margin-left: 6px; -webkit-text-fill-color: #140c07; }

        nav { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        nav a {
            color: #f3eae0; text-decoration: none; font-weight: 600; font-size: 14px;
            padding: 10px 18px; border-radius: 50px; border: 1px solid rgba(212, 175, 55, 0.3); transition: 0.25s;
        }
        nav a:hover { border-color: var(--gold-bright); color: var(--gold-bright); }
        nav a.active { background: linear-gradient(135deg, var(--crimson) 0%, #d32f2f 100%); color: #fff; border-color: var(--gold); }
        .nav-wsp { background: var(--wsp) !important; color: #fff !important; border-color: #fff !important; font-weight: 700 !important; }

        /* Barra informativa de Pagos y WhatsApp */
        .payment-strip {
            background: #24150d;
            color: #fff;
            padding: 10px 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 13px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }
        .pay-pill { padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; }
        .pill-yape { background: var(--yape); color: #fff; }
        .pill-plin { background: var(--plin); color: #fff; }
        .pill-card { background: #d4af37; color: #140c07; }
        .pill-wsp { background: var(--wsp); color: #fff; text-decoration: none; }

        .hero {
            background: linear-gradient(rgba(17, 9, 5, 0.76), rgba(17, 9, 5, 0.88)),
                        url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1400&q=80') center/cover;
            padding: 34px 20px;
            text-align: center;
            color: #fff;
            border-bottom: 2px solid var(--gold);
        }
        .hero h2 { font-family: 'Playfair Display', serif; font-size: 32px; margin: 0 0 8px 0; color: var(--gold-bright); }
        .hero p { margin: 0; font-size: 15px; color: #e0d4c8; }

        .container { max-width: 1260px; margin: 30px auto; padding: 0 24px; }
        .panel {
            background: var(--white); border-radius: 16px; padding: 26px;
            box-shadow: 0 10px 30px rgba(36, 21, 13, 0.08); margin-bottom: 28px; border: 1px solid rgba(212, 175, 55, 0.35);
        }
        .panel-header {
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;
            gap: 15px; border-bottom: 2px solid #f2ebe1; padding-bottom: 14px; margin-bottom: 20px;
        }
        .panel-title { font-family: 'Playfair Display', serif; font-size: 22px; margin: 0; color: var(--wood-dark); }

        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(185px, 1fr)); gap: 15px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: var(--wood-mid); }
        input, select {
            padding: 11px 14px; border: 1.5px solid #dfd5c8; border-radius: 10px;
            font-size: 14px; background: #fffdf9; color: var(--text-main); outline: none;
        }
        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f3d06b 100%); color: #1a0f07;
            border: none; padding: 12px 24px; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer;
        }

        /* Galería de Platos */
        .catalog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(275px, 1fr)); gap: 24px; }
        .dish-card {
            background: var(--white); border-radius: 14px; overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.07); border: 1px solid #ece3d5;
            transition: transform 0.25s ease, box-shadow 0.25s ease; display: flex; flex-direction: column;
        }
        .dish-card:hover { transform: translateY(-6px); box-shadow: 0 14px 32px rgba(20, 12, 7, 0.16); border-color: var(--gold); }
        .dish-img-box { position: relative; width: 100%; height: 205px; overflow: hidden; background: #24150d; }
        .dish-img-box img { width: 100% !important; height: 205px !important; object-fit: cover; transition: transform 0.4s ease; }
        .dish-card:hover .dish-img-box img { transform: scale(1.07); }

        .cat-tag {
            position: absolute; top: 12px; left: 12px; background: rgba(20, 12, 7, 0.85);
            color: var(--gold-bright); border: 1px solid var(--gold); padding: 5px 12px;
            border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;
        }
        .price-badge {
            position: absolute; bottom: 12px; right: 12px;
            background: linear-gradient(135deg, var(--crimson) 0%, #c62828 100%); color: #fff;
            padding: 6px 14px; border-radius: 8px; font-weight: 800; font-size: 16px;
        }
        .dish-content { padding: 18px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .dish-code { font-size: 11px; color: var(--text-muted); font-weight: 700; }
        .dish-name { font-family: 'Playfair Display', serif; font-size: 20px; margin: 4px 0 8px 0; color: var(--wood-dark); }
        .dish-desc { font-size: 13px; color: var(--text-muted); line-height: 1.5; margin: 0 0 15px 0; }
        .dish-bottom { display: flex; justify-content: space-between; align-items: center; gap: 8px; padding-top: 12px; border-top: 1px solid #f2ebe1; }
        .stock-badge { background: #e8f5e9; color: #1b5e20; padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .btn-edit-card { background: var(--wood-mid); color: var(--gold-bright); border: 1px solid var(--gold); padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; }
        .btn-wsp-card { background: var(--wsp); color: #fff; text-decoration: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; }

        /* Botón Flotante de WhatsApp */
        .float-wsp {
            position: fixed; bottom: 24px; right: 24px; background: var(--wsp); color: #fff;
            padding: 14px 22px; border-radius: 50px; font-weight: 800; font-size: 15px;
            text-decoration: none; box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
            display: flex; align-items: center; gap: 10px; z-index: 1500; border: 2px solid #fff;
        }
        .alerta { display: none; padding: 15px 20px; background: #1b5e20; color: #fff; border-left: 5px solid var(--gold); border-radius: 10px; margin-bottom: 20px; font-weight: 600; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 8, 4, 0.75); justify-content: center; align-items: center; z-index: 2000; }
        .modal-box { background: #fff; padding: 28px; border-radius: 16px; width: 480px; max-width: 92%; border: 2px solid var(--gold); }
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
        <a href="index.php" class="active">🍽️ Carta Gourmet</a>
        <a href="pedidos.php">🧾 Pedidos y Pagos</a>
        <a href="reportes.php">📊 Reportes y Caja</a>
        <a href="https://wa.me/51968752081?text=Hola%20El%20Rinc%C3%B3n%20del%20Sabor,%20deseo%20hacer%20un%20pedido" target="_blank" class="nav-wsp">📲 WhatsApp: 968 752 081</a>
    </nav>
</header>

<div class="payment-strip">
    <span><strong>💳 Métodos de Pago Oficiales:</strong></span>
    <span class="pay-pill pill-yape">📱 Yape: 968 752 081</span>
    <span class="pay-pill pill-plin">📱 Plin: 968 752 081</span>
    <span class="pay-pill pill-card">💵 Efectivo y Tarjetas Visa / Mastercard</span>
    <a href="https://wa.me/51968752081?text=Hola,%20env%C3%ADo%20mi%20comprobante%20Yape/Plin" target="_blank" class="pay-pill pill-wsp">💬 Enviar Captura al 968 752 081</a>
</div>

<section class="hero">
    <h2>Gran Carta de Especialidades Peruanas</h2>
    <p>Disfruta de nuestros platos criollos, marinos y bebidas artesanales con atención en salón y pedidos por WhatsApp</p>
</section>

<div class="container">
    <div id="mensaje-alerta" class="alerta"></div>

    <!-- Formulario para añadir plato -->
    <div class="panel">
        <div class="panel-header">
            <h3 class="panel-title">✨ Registrar Nuevo Producto en la Carta</h3>
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
                    <input type="text" id="codigo" placeholder="Ej. PLT-006" required>
                </div>
                <div class="form-group">
                    <label>Nombre del Producto</label>
                    <input type="text" id="nombre" placeholder="Ej. Jalea Real Mixta" required>
                </div>
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="precio" step="0.10" min="0.50" placeholder="35.00" required>
                </div>
                <div class="form-group">
                    <label>Stock Disponible</label>
                    <input type="number" id="stock" min="1" value="30" required>
                </div>
            </div>
            <div class="form-group" style="margin-top: 14px;">
                <label>Descripción Gastronómica</label>
                <input type="text" id="descripcion" placeholder="Ingredientes y guarniciones...">
            </div>
            <button type="submit" class="btn-gold" style="margin-top: 16px;">+ Publicar en la Carta</button>
        </form>
    </div>

    <!-- Galería Visual -->
    <div class="panel">
        <div class="panel-header">
            <h3 class="panel-title">📖 Catálogo Fotográfico de Especialidades</h3>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <input type="text" id="buscador" placeholder="🔍 Buscar plato o bebida..." onkeyup="filtrarCarta()" style="width:230px;">
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
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h3 style="margin:0; font-family:'Playfair Display', serif;">✏️ Editar Producto</h3>
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
                <label>Nombre</label>
                <input type="text" id="edit-nombre" required>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" id="edit-precio" step="0.10" required>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" id="edit-stock" min="0" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:12px;">
                <label>Descripción</label>
                <input type="text" id="edit-descripcion">
            </div>
            <div class="form-group" style="margin-bottom:18px;">
                <label>Estado</label>
                <select id="edit-condicion">
                    <option value="1">Disponible</option>
                    <option value="0">Agotado</option>
                </select>
            </div>
            <button type="submit" class="btn-gold" style="width:100%;">Guardar Cambios</button>
        </form>
    </div>
</div>

<a href="https://wa.me/51968752081?text=Hola%20El%20Rinc%C3%B3n%20del%20Sabor,%20quisiera%20realizar%20un%20pedido%20y%20pagar%20por%20Yape/Plin" target="_blank" class="float-wsp">
    📲 Pedidos y Yape: 968 752 081
</a>

<script>
let listaPlatos = [];

// Mapeo fotográfico preciso para cada plato peruano según su nombre
function obtenerFotoExacta(plato) {
    const n = plato.nombre.toLowerCase();
    // 1. Papa a la Huancaína
    if (n.includes('huanca') || n.includes('papa')) 
        return 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?auto=format&fit=crop&w=700&q=80';
    // 2. Ceviche Clásico
    if (n.includes('ceviche') || n.includes('cebiche')) 
        return 'https://images.unsplash.com/photo-1535399831218-d5bd36d1a6b3?auto=format&fit=crop&w=700&q=80';
    // 3. Causa Limeña
    if (n.includes('causa')) 
        return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80';
    // 4. Anticuchos a la Parrilla
    if (n.includes('anticucho') || n.includes('brocheta') || n.includes('parrilla')) 
        return 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=700&q=80';
    // 5. Lomo Saltado Clásico
    if (n.includes('lomo')) 
        return 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=700&q=80';
    // 6. Trucha Frita Dorada
    if (n.includes('trucha') || n.includes('pescado frito')) 
        return 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&w=700&q=80';
    // 7. Arroz con Mariscos
    if (n.includes('marisco') || n.includes('paella') || n.includes('jalea')) 
        return 'https://images.unsplash.com/photo-1534080564583-6be75777b70a?auto=format&fit=crop&w=700&q=80';
    // 8. Ají de Gallina / Pollo
    if (n.includes('gallina') || n.includes('pollo')) 
        return 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=700&q=80';
    // 9. Seco de Cordero / Carne
    if (n.includes('cordero') || n.includes('seco') || n.includes('asado')) 
        return 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=700&q=80';
    // 10. Chicha Morada
    if (n.includes('chicha')) 
        return 'https://images.unsplash.com/photo-1556881286-fc6915169721?auto=format&fit=crop&w=700&q=80';
    // 11. Pisco Sour
    if (n.includes('pisco') || n.includes('sour') || n.includes('coctel')) 
        return 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=700&q=80';
    // 12. Limonada Frozen
    if (n.includes('limonada') || n.includes('jugo') || plato.categoria === 'Bebidas') 
        return 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=700&q=80';

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

    datos.forEach(p => {
        const foto = obtenerFotoExacta(p);
        const msgWsp = encodeURIComponent(`Hola El Rincón del Sabor, deseo pedir: *${p.nombre}* (S/ ${parseFloat(p.precio).toFixed(2)}). ¿Me confirma su Yape/Plin 968752081?`);

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
                        <p class="dish-desc">${p.descripcion || 'Especialidad preparada al instante.'}</p>
                    </div>
                    <div class="dish-bottom">
                        <span class="stock-badge">🔥 ${p.stock} disp.</span>
                        <div style="display:flex; gap:6px;">
                            <a href="https://wa.me/51968752081?text=${msgWsp}" target="_blank" class="btn-wsp-card">📲 Pedir</a>
                            <button class="btn-edit-card" onclick="abrirModal(${p.idplato})">✏️</button>
                        </div>
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
        mostrarAlerta('✅ ¡Producto agregado exitosamente a la carta v6.0!');
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
        mostrarAlerta('✅ ¡Producto actualizado!');
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