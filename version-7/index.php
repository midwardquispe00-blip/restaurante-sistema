<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | E-Commerce Gourmet v7.0</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ==========================================================================
           VARIABLES DE TEMA (MODO OSCURO GOURMET / MODO CLARO CÁLIDO)
           ========================================================================== */
        :root[data-theme="dark"] {
            --bg-body: #0f0a07;
            --bg-surface: #1b120c;
            --bg-card: #22160f;
            --bg-glass: rgba(27, 18, 12, 0.82);
            --text-primary: #fdf8f2;
            --text-secondary: #c2b2a3;
            --border-color: rgba(212, 175, 55, 0.25);
            --input-bg: #140c08;
            --shadow-card: 0 14px 34px rgba(0, 0, 0, 0.45);
        }
        :root[data-theme="light"] {
            --bg-body: #faf6f0;
            --bg-surface: #ffffff;
            --bg-card: #ffffff;
            --bg-glass: rgba(255, 255, 255, 0.88);
            --text-primary: #24150d;
            --text-secondary: #6e5a4f;
            --border-color: rgba(212, 175, 55, 0.4);
            --input-bg: #fcf9f5;
            --shadow-card: 0 12px 30px rgba(36, 21, 13, 0.08);
        }
        :root {
            --gold: #d4af37;
            --gold-light: #f9d976;
            --crimson: #b91c1c;
            --crimson-light: #ef4444;
            --emerald: #10b981;
            --yape: #742284;
            --plin: #00b4d8;
            --wsp: #25D366;
            --radius-xl: 18px;
            --radius-md: 12px;
        }

        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; transition: background-color 0.25s ease, color 0.2s ease, border-color 0.2s ease; }
        body { margin: 0; background-color: var(--bg-body); color: var(--text-primary); overflow-x: hidden; }

        /* ==========================================================================
           NAVBAR GLASSMORPHISM
           ========================================================================== */
        header {
            position: sticky; top: 0; z-index: 1000;
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1.5px solid var(--border-color);
            padding: 12px 36px;
            display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;
        }
        .brand { display: flex; align-items: center; gap: 14px; text-decoration: none; }
        .brand-logo {
            width: 60px !important; height: 60px !important;
            border-radius: 50%; border: 2px solid var(--gold);
            object-fit: cover; box-shadow: 0 0 18px rgba(212, 175, 55, 0.45);
        }
        .brand-title h1 {
            font-family: 'Playfair Display', serif; font-size: 24px; margin: 0;
            background: linear-gradient(90deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-title span { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: var(--text-secondary); display: block; }
        .badge-v7 {
            background: linear-gradient(135deg, var(--crimson), #991b1b);
            color: #fff; font-size: 11px; font-weight: 800; padding: 3px 10px;
            border-radius: 20px; border: 1px solid var(--gold); margin-left: 6px;
            -webkit-text-fill-color: #fff;
        }

        .nav-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .nav-link {
            color: var(--text-primary); text-decoration: none; font-weight: 600; font-size: 13.5px;
            padding: 9px 16px; border-radius: 30px; border: 1px solid var(--border-color);
            background: rgba(212, 175, 55, 0.06); cursor: pointer; display: inline-flex; align-items: center; gap: 7px;
        }
        .nav-link:hover, .nav-link.active {
            border-color: var(--gold); background: linear-gradient(135deg, rgba(212,175,55,0.22), rgba(185,28,28,0.25));
        }

        .btn-cart-trigger {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #140c07; font-weight: 800; border: none; padding: 10px 20px;
            border-radius: 30px; cursor: pointer; display: flex; align-items: center; gap: 8px;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.35); font-size: 14px;
        }
        .btn-cart-trigger:hover { transform: translateY(-2px); }
        .cart-counter {
            background: var(--crimson); color: #fff; font-size: 12px; font-weight: 800;
            padding: 2px 8px; border-radius: 20px;
        }

        /* ==========================================================================
           HERO BANNER
           ========================================================================== */
        .hero {
            background: linear-gradient(rgba(15, 10, 7, 0.72), rgba(15, 10, 7, 0.9)),
                        url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1500&q=80') center/cover;
            padding: 42px 24px; text-align: center; border-bottom: 1.5px solid var(--border-color);
        }
        .hero h2 { font-family: 'Playfair Display', serif; font-size: 36px; margin: 0 0 10px; color: var(--gold-light); }
        .hero p { max-width: 680px; margin: 0 auto 18px; color: #e5d8c8; font-size: 15px; }
        .hero-badges { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }
        .hero-pill {
            background: rgba(255,255,255,0.1); backdrop-filter: blur(8px);
            border: 1px solid rgba(212, 175, 55, 0.4); color: #fff;
            padding: 6px 14px; border-radius: 30px; font-size: 12.5px; font-weight: 600;
        }

        /* ==========================================================================
           CONTENEDOR Y BARRA DE HERRAMIENTAS
           ========================================================================== */
        .container { max-width: 1320px; margin: 28px auto; padding: 0 24px; }

        .toolbar {
            background: var(--bg-surface); border: 1px solid var(--border-color);
            border-radius: var(--radius-xl); padding: 18px 22px; margin-bottom: 28px;
            display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;
            box-shadow: var(--shadow-card);
        }
        .search-box { flex: 1; min-width: 240px; position: relative; }
        .search-box input {
            width: 100%; padding: 12px 16px 12px 40px; border-radius: 30px;
            border: 1.5px solid var(--border-color); background: var(--input-bg);
            color: var(--text-primary); font-size: 14px; outline: none;
        }
        .search-box input:focus { border-color: var(--gold); }
        .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); opacity: 0.6; }

        .category-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
        .cat-btn {
            background: var(--input-bg); color: var(--text-secondary);
            border: 1px solid var(--border-color); padding: 9px 16px; border-radius: 30px;
            font-weight: 700; font-size: 13px; cursor: pointer;
        }
        .cat-btn.active, .cat-btn:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #140c07; border-color: transparent;
        }

        .btn-primary-gradient {
            background: linear-gradient(135deg, var(--crimson), #dc2626);
            color: #fff; border: 1px solid var(--gold); padding: 11px 20px;
            border-radius: 30px; font-weight: 800; font-size: 13.5px; cursor: pointer;
            box-shadow: 0 6px 18px rgba(185, 28, 28, 0.35);
        }
        .btn-primary-gradient:hover { transform: translateY(-2px); }

        /* ==========================================================================
           GRID DE PRODUCTOS CON MICRO-INTERACCIONES
           ========================================================================== */
        .catalog-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(285px, 1fr)); gap: 24px;
        }
        .product-card {
            background: var(--bg-card); border-radius: var(--radius-xl);
            border: 1px solid var(--border-color); overflow: hidden;
            box-shadow: var(--shadow-card); display: flex; flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.16);
            border-color: var(--gold);
        }
        .card-img-wrap {
            position: relative; height: 210px; width: 100%; overflow: hidden; background: #160d08;
        }
        .card-img-wrap img {
            width: 100% !important; height: 210px !important; object-fit: cover;
            transition: transform 0.5s ease;
        }
        .product-card:hover .card-img-wrap img { transform: scale(1.08); }

        .card-cat-pill {
            position: absolute; top: 12px; left: 12px;
            background: rgba(15, 10, 7, 0.82); backdrop-filter: blur(6px);
            color: var(--gold-light); border: 1px solid var(--gold);
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;
        }
        .card-admin-btns {
            position: absolute; top: 12px; right: 12px; display: flex; gap: 6px;
        }
        .icon-btn {
            width: 34px; height: 34px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.25);
            background: rgba(15, 10, 7, 0.8); color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center; font-size: 14px;
            backdrop-filter: blur(4px);
        }
        .icon-btn:hover { background: var(--gold); color: #140c07; }
        .icon-btn.del:hover { background: var(--crimson-light); color: #fff; }

        .card-price-badge {
            position: absolute; bottom: 12px; right: 12px;
            background: linear-gradient(135deg, var(--crimson), #991b1b);
            color: #fff; padding: 6px 14px; border-radius: 10px;
            font-weight: 800; font-size: 16px; border: 1px solid rgba(255,255,255,0.25);
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }

        .card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .card-code { font-size: 11px; color: var(--text-secondary); font-weight: 700; letter-spacing: 1px; }
        .card-title { font-family: 'Playfair Display', serif; font-size: 20px; margin: 4px 0 8px; color: var(--text-primary); }
        .card-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.5; margin: 0 0 16px; }

        .card-footer {
            display: flex; justify-content: space-between; align-items: center; gap: 10px;
            padding-top: 12px; border-top: 1px solid var(--border-color);
        }
        .stock-tag {
            font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: 20px;
            background: rgba(16, 185, 129, 0.15); color: var(--emerald);
        }
        .stock-tag.low { background: rgba(239, 68, 68, 0.15); color: var(--crimson-light); }

        .btn-add-cart {
            flex: 1; background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #140c07; border: none; padding: 10px 14px; border-radius: 10px;
            font-weight: 800; font-size: 13px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .btn-add-cart:hover { filter: brightness(1.06); transform: scale(1.02); }

        /* ==========================================================================
           DRAWER LATERAL DEL CARRITO
           ========================================================================== */
        .drawer-overlay {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(4px); z-index: 2000; display: none; opacity: 0; transition: opacity 0.25s ease;
        }
        .drawer-overlay.open { display: block; opacity: 1; }

        .cart-drawer {
            position: fixed; top: 0; right: -430px; width: 410px; max-width: 92vw; height: 100vh;
            background: var(--bg-surface); border-left: 2px solid var(--gold);
            z-index: 2001; display: flex; flex-direction: column;
            box-shadow: -10px 0 35px rgba(0,0,0,0.5); transition: right 0.32s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .cart-drawer.open { right: 0; }
        .drawer-header {
            padding: 20px 22px; border-bottom: 1px solid var(--border-color);
            display: flex; justify-content: space-between; align-items: center;
        }
        .drawer-header h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 22px; color: var(--gold); }
        .drawer-body { flex: 1; overflow-y: auto; padding: 18px 22px; }
        .cart-item {
            display: flex; align-items: center; gap: 12px; padding: 12px;
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 12px; margin-bottom: 12px;
        }
        .cart-item img { width: 58px; height: 58px; border-radius: 10px; object-fit: cover; border: 1px solid var(--gold); }
        .cart-item-info { flex: 1; }
        .cart-item-title { font-weight: 700; font-size: 14px; margin-bottom: 4px; }
        .cart-item-price { color: var(--gold); font-weight: 800; font-size: 13px; }
        .qty-controls { display: flex; align-items: center; gap: 6px; }
        .qty-btn {
            width: 28px; height: 28px; border-radius: 8px; border: 1px solid var(--border-color);
            background: var(--input-bg); color: var(--text-primary); font-weight: 800; cursor: pointer;
        }
        .qty-btn:hover { background: var(--gold); color: #140c07; }

        .drawer-footer {
            padding: 20px 22px; border-top: 1px solid var(--border-color); background: var(--bg-card);
        }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; color: var(--text-secondary); }
        .summary-total {
            display: flex; justify-content: space-between; font-size: 20px; font-weight: 800;
            color: var(--gold-light); padding-top: 10px; border-top: 1px dashed var(--border-color); margin-bottom: 16px;
        }
        .btn-checkout-qr {
            width: 100%; padding: 14px; border-radius: 12px; border: none;
            background: linear-gradient(135deg, var(--emerald), #059669);
            color: #fff; font-weight: 800; font-size: 15px; cursor: pointer;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        /* ==========================================================================
           MODALES (CRUD CON VISTA PREVIA EN VIVO & CHECKOUT QR)
           ========================================================================== */
        .modal-backdrop {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px); z-index: 3000; display: none;
            align-items: center; justify-content: center; padding: 18px; overflow-y: auto;
        }
        .modal-backdrop.open { display: flex; }
        .modal-window {
            background: var(--bg-surface); border: 1.5px solid var(--gold);
            border-radius: var(--radius-xl); width: 100%; max-width: 860px;
            padding: 26px; box-shadow: 0 25px 60px rgba(0,0,0,0.65); max-height: 92vh; overflow-y: auto;
        }
        .modal-header {
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid var(--border-color); padding-bottom: 14px; margin-bottom: 20px;
        }
        .modal-header h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 23px; color: var(--gold); }
        .close-x { background: none; border: none; color: var(--text-secondary); font-size: 26px; cursor: pointer; }

        .crud-split { display: grid; grid-template-columns: 1.3fr 1fr; gap: 24px; align-items: start; }
        @media (max-width: 780px) { .crud-split { grid-template-columns: 1fr; } }

        .form-group { margin-bottom: 14px; display: flex; flex-direction: column; }
        .form-group label { font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: var(--text-secondary); }
        .form-group input, .form-group select, .form-group textarea {
            padding: 11px 14px; border-radius: 10px; border: 1.5px solid var(--border-color);
            background: var(--input-bg); color: var(--text-primary); font-size: 14px; outline: none;
        }
        .form-group input:focus { border-color: var(--gold); }

        .file-upload-label {
            border: 1.5px dashed var(--gold); border-radius: 10px; padding: 12px;
            text-align: center; cursor: pointer; background: rgba(212, 175, 55, 0.06);
            font-size: 13px; font-weight: 600; color: var(--gold-light);
        }

        /* ==========================================================================
           ESTILOS DEL MODAL CHECKOUT CON CÓDIGO QR
           ========================================================================== */
        .qr-checkout-grid { display: grid; grid-template-columns: 1fr 1.15fr; gap: 24px; align-items: center; }
        @media (max-width: 760px) { .qr-checkout-grid { grid-template-columns: 1fr; } }

        .qr-display-card {
            background: linear-gradient(145deg, #2d1238, #16091e);
            border: 2px solid var(--gold); border-radius: 18px; padding: 20px;
            text-align: center; color: #fff; box-shadow: 0 12px 30px rgba(116, 34, 132, 0.4);
        }
        .qr-frame {
            background: #fff; padding: 12px; border-radius: 14px; display: inline-block;
            margin: 12px auto; box-shadow: 0 6px 20px rgba(0,0,0,0.35);
        }
        .qr-frame img { width: 200px !important; height: 200px !important; object-fit: contain; display: block; }
        .qr-amount-pill {
            background: var(--gold); color: #140c07; font-weight: 800; font-size: 20px;
            padding: 6px 18px; border-radius: 30px; display: inline-block; margin-top: 6px;
        }
        .qr-actions { display: flex; gap: 8px; justify-content: center; margin-top: 12px; flex-wrap: wrap; }
        .btn-qr-tool {
            background: rgba(255,255,255,0.14); color: #fff; border: 1px solid rgba(255,255,255,0.3);
            padding: 8px 13px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;
        }
        .btn-qr-tool:hover { background: var(--gold); color: #140c07; }

        /* ==========================================================================
           TOAST NOTIFICATIONS
           ========================================================================== */
        .toast-container {
            position: fixed; bottom: 24px; right: 24px; z-index: 5000;
            display: flex; flex-direction: column; gap: 10px;
        }
        .toast {
            background: var(--bg-surface); color: var(--text-primary);
            border-left: 5px solid var(--gold); border-top: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);
            padding: 14px 20px; border-radius: 12px; font-weight: 700; font-size: 13.5px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.45); display: flex; align-items: center; gap: 10px;
            animation: slideIn 0.25s ease forwards;
        }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
</head>
<body>

<!-- ================= NAVBAR GLASSMORPHISM ================= -->
<header>
    <a href="index.php" class="brand">
        <img src="assets/img/logo.jpg" alt="Logo" class="brand-logo" onerror="this.src='https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=200&q=80'">
        <div class="brand-title">
            <h1>El Rincón del Sabor <span class="badge-v7">v7.0 PRO</span></h1>
            <span>Alta Cocina Peruana &amp; Pagos QR Instantáneos</span>
        </div>
    </a>

    <div class="nav-actions">
        <a href="index.php" class="nav-link active">🍽️ Catálogo</a>
        <a href="pedidos.php" class="nav-link">🧾 Salón / Caja</a>
        <a href="reportes.php" class="nav-link">📊 Reportes</a>
        <button class="nav-link" onclick="abrirModalConfigQR()">⚙️ Configurar QR</button>
        <button class="nav-link" onclick="toggleTheme()" id="btn-theme">☀️ Modo Claro</button>
        <button class="btn-cart-trigger" onclick="toggleCart(true)">
            🛒 Carrito <span class="cart-counter" id="cart-badge">0</span>
        </button>
    </div>
</header>

<!-- ================= HERO BANNER ================= -->
<section class="hero">
    <h2>Experiencia Gastronómica &amp; Pedido Digital</h2>
    <p>Selecciona tus platos favoritos, personaliza tu orden y paga al instante escaneando nuestro código QR oficial de Yape, Plin o transferencia.</p>
    <div class="hero-badges">
        <span class="hero-pill">📱 Yape / Plin Oficial: 968 752 081</span>
        <span class="hero-pill">⚡ Confirmación Inmediata con Código de Orden</span>
        <span class="hero-pill">🖼️ Gestión CRUD con Previsualización en Vivo</span>
    </div>
</section>

<!-- ================= CONTENIDO PRINCIPAL ================= -->
<div class="container">
    <div class="toolbar">
        <div class="search-box">
            <span class="search-icon">🔍</span>
            <input type="text" id="buscador" placeholder="Buscar plato por nombre, ingrediente o código..." oninput="filtrarCatalogo()">
        </div>

        <div class="category-tabs">
            <button class="cat-btn active" onclick="seleccionarCategoria('', this)">Todos</button>
            <button class="cat-btn" onclick="seleccionarCategoria('Entradas', this)">🥗 Entradas</button>
            <button class="cat-btn" onclick="seleccionarCategoria('Platos de Fondo', this)">🍛 Platos de Fondo</button>
            <button class="cat-btn" onclick="seleccionarCategoria('Bebidas', this)">🍹 Bebidas</button>
        </div>

        <button class="btn-primary-gradient" onclick="abrirModalProducto()">+ Nuevo Producto</button>
    </div>

    <!-- Galería de Productos -->
    <div id="catalogo-grid" class="catalog-grid"></div>
</div>

<!-- ================= DRAWER LATERAL DEL CARRITO ================= -->
<div id="drawer-overlay" class="drawer-overlay" onclick="toggleCart(false)"></div>
<aside id="cart-drawer" class="cart-drawer">
    <div class="drawer-header">
        <h3>🛒 Tu Orden Gourmet</h3>
        <button class="close-x" onclick="toggleCart(false)">&times;</button>
    </div>
    <div class="drawer-body" id="cart-items-container"></div>
    <div class="drawer-footer">
        <div class="summary-row">
            <span>Subtotal de productos</span>
            <span id="cart-subtotal">S/ 0.00</span>
        </div>
        <div class="summary-row">
            <span>Servicio de empaque / salón</span>
            <span>Gratis</span>
        </div>
        <div class="summary-total">
            <span>Total a Pagar:</span>
            <span id="cart-total">S/ 0.00</span>
        </div>
        <button class="btn-checkout-qr" onclick="abrirModalCheckoutQR()">
            📱 Finalizar Compra / Pago Rápido con QR
        </button>
    </div>
</aside>

<!-- ================= MODAL 1: CRUD DE PRODUCTO CON PREVISUALIZACIÓN EN TIEMPO REAL ================= -->
<div id="modal-producto" class="modal-backdrop">
    <div class="modal-window">
        <div class="modal-header">
            <h3 id="modal-prod-titulo">✨ Agregar Nuevo Producto</h3>
            <button class="close-x" onclick="cerrarModalProducto()">&times;</button>
        </div>

        <div class="crud-split">
            <!-- Formulario Izquierdo -->
            <form id="form-producto">
                <input type="hidden" id="prod-id">
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label>Categoría *</label>
                        <select id="prod-categoria" onchange="actualizarVistaPrevia()" required>
                            <option value="1" data-nombre="Entradas">Entradas</option>
                            <option value="2" data-nombre="Platos de Fondo" selected>Platos de Fondo</option>
                            <option value="3" data-nombre="Bebidas">Bebidas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Código *</label>
                        <input type="text" id="prod-codigo" placeholder="Ej. PLT-015" oninput="actualizarVistaPrevia()" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nombre del Plato o Bebida *</label>
                    <input type="text" id="prod-nombre" placeholder="Ej. Fetuccini a la Huancaína con Lomo" oninput="actualizarVistaPrevia()" required>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label>Precio (S/.) *</label>
                        <input type="number" id="prod-precio" step="0.10" min="0.50" placeholder="34.00" oninput="actualizarVistaPrevia()" required>
                    </div>
                    <div class="form-group">
                        <label>Stock *</label>
                        <input type="number" id="prod-stock" min="0" value="30" oninput="actualizarVistaPrevia()" required>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select id="prod-condicion" onchange="actualizarVistaPrevia()">
                            <option value="1">Disponible</option>
                            <option value="0">Agotado</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción Gastronómica</label>
                    <input type="text" id="prod-descripcion" placeholder="Ingredientes, guarnición y preparación..." oninput="actualizarVistaPrevia()">
                </div>

                <div class="form-group">
                    <label>Imagen del Producto (Subir Archivo Local o Pegar URL)</label>
                    <label class="file-upload-label">
                        📁 Seleccionar Foto desde tu PC (JPG, PNG, WEBP)
                        <input type="file" id="prod-file" accept="image/*" style="display:none;" onchange="procesarArchivoImagen(event)">
                    </label>
                    <input type="text" id="prod-imagen-url" placeholder="...o pega aquí una URL de imagen (https://...)" style="margin-top:8px;" oninput="actualizarImagenDesdeURL()">
                </div>

                <button type="submit" class="btn-add-cart" style="width:100%; padding:13px; font-size:14.5px; margin-top:6px;">
                    💾 Guardar Producto en el Catálogo
                </button>
            </form>

            <!-- Vista Previa en Tiempo Real Derecha -->
            <div>
                <div style="font-size:12px; font-weight:800; text-transform:uppercase; color:var(--gold); margin-bottom:10px; letter-spacing:1px;">
                    👁️ Vista Previa en Tiempo Real
                </div>
                <div class="product-card" style="pointer-events:none;">
                    <div class="card-img-wrap">
                        <img id="prev-img" src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=700&q=80" alt="Vista previa">
                        <span class="card-cat-pill" id="prev-cat">Platos de Fondo</span>
                        <span class="card-price-badge" id="prev-precio">S/ 0.00</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <span class="card-code" id="prev-codigo">PLT-000</span>
                            <h4 class="card-title" id="prev-nombre">Nombre del Producto</h4>
                            <p class="card-desc" id="prev-desc">Descripción gourmet del plato...</p>
                        </div>
                        <div class="card-footer">
                            <span class="stock-tag" id="prev-stock">🔥 30 disp.</span>
                            <span class="btn-add-cart" style="max-width:130px;">+ Agregar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL 2: CHECKOUT DE PAGO RÁPIDO CON CÓDIGO QR ================= -->
<div id="modal-checkout-qr" class="modal-backdrop">
    <div class="modal-window" style="max-width: 820px;">
        <div class="modal-header">
            <h3>📲 Finalizar Compra — Pago Rápido con Código QR</h3>
            <button class="close-x" onclick="cerrarModalCheckoutQR()">&times;</button>
        </div>

        <div id="checkout-form-view" class="qr-checkout-grid">
            <!-- Tarjeta QR Izquierda -->
            <div class="qr-display-card">
                <div style="font-size:12px; font-weight:800; letter-spacing:1.5px; color:var(--gold-light);">ESCANEA CON YAPE / PLIN / BANCA MÓVIL</div>
                <div class="qr-frame">
                    <img id="checkout-qr-img" src="" alt="Código QR Oficial">
                </div>
                <div>Monto exacto a transferir:</div>
                <div class="qr-amount-pill" id="qr-monto-total">S/ 0.00</div>
                <div style="margin-top:10px; font-size:13.5px; font-weight:700;">
                    Titular: El Rincón del Sabor<br>
                    Número Yape / Plin: <span id="qr-numero-texto" style="color:var(--gold-light);">968 752 081</span>
                </div>
                <div class="qr-actions">
                    <button type="button" class="btn-qr-tool" onclick="copiarNumeroCuenta()">📋 Copiar Número</button>
                    <button type="button" class="btn-qr-tool" onclick="descargarImagenQR()">⬇️ Descargar QR</button>
                </div>
            </div>

            <!-- Formulario de Verificación Derecha -->
            <form id="form-confirmar-pago">
                <div class="form-group">
                    <label>Nombre Completo del Cliente *</label>
                    <input type="text" id="chk-cliente" placeholder="Ej. Roy Aldair Flores" required>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label>Modalidad / Mesa *</label>
                        <select id="chk-mesa">
                            <option value="Mesa 01 - Salón">Mesa 01 - Salón</option>
                            <option value="Mesa 02 - Salón">Mesa 02 - Salón</option>
                            <option value="Mesa 03 - VIP">Mesa 03 - VIP</option>
                            <option value="Para Llevar / Recojo">Para Llevar / Recojo</option>
                            <option value="Delivery Express">Delivery Express</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Billetera / Método Usado *</label>
                        <select id="chk-metodo">
                            <option value="Yape QR (968752081)">📱 Yape QR (968 752 081)</option>
                            <option value="Plin QR (968752081)">📱 Plin QR (968 752 081)</option>
                            <option value="Transferencia CCI">🏦 Transferencia Bancaria</option>
                            <option value="Efectivo contraentrega">💵 Efectivo en Caja</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>N° de Operación o Subir Captura de Comprobante *</label>
                    <input type="text" id="chk-operacion" placeholder="Ej. Operación #0482910 (o adjunta captura abajo)" required>
                    <label class="file-upload-label" style="margin-top:8px;">
                        📸 Adjuntar Captura de Pago (Opcional)
                        <input type="file" id="chk-captura" accept="image/*" style="display:none;" onchange="mostrarNombreCaptura(event)">
                    </label>
                    <small id="captura-nombre" style="color:var(--emerald); margin-top:4px; font-weight:700;"></small>
                </div>

                <button type="submit" class="btn-checkout-qr" style="margin-top:10px;">
                    ✅ Confirmar Pago y Generar Orden
                </button>
            </form>
        </div>

        <!-- Vista de Confirmación Exitosa -->
        <div id="checkout-success-view" style="display:none; text-align:center; padding:24px 10px;">
            <div style="font-size:54px;">🎉</div>
            <h2 style="font-family:'Playfair Display', serif; color:var(--emerald); margin:8px 0;">¡Pago en Verificación / Pedido Exitoso!</h2>
            <p style="color:var(--text-secondary); max-width:500px; margin:0 auto 16px;">
                Hemos registrado tu pedido y validado tu comprobante. Cocina ya está preparando tu orden.
            </p>
            <div style="background:var(--bg-card); border:1.5px dashed var(--gold); padding:16px 24px; border-radius:14px; display:inline-block; margin-bottom:20px;">
                <div style="font-size:12px; color:var(--text-secondary);">CÓDIGO DE ORDEN GENERADO</div>
                <div id="orden-generada-codigo" style="font-size:28px; font-weight:800; color:var(--gold-light); letter-spacing:2px;">ORD-00001</div>
            </div>
            <div style="display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
                <button class="btn-add-cart" style="max-width:260px; padding:12px 20px;" onclick="enviarComprobanteWhatsApp()">
                    📲 Enviar Orden a WhatsApp (968 752 081)
                </button>
                <button class="nav-link" onclick="cerrarModalCheckoutQR()">Seguir Comprando</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL 3: CONFIGURAR IMAGEN DEL QR (ADMIN) ================= -->
<div id="modal-config-qr" class="modal-backdrop">
    <div class="modal-window" style="max-width: 480px;">
        <div class="modal-header">
            <h3>⚙️ Configurar QR Oficial de Cobro</h3>
            <button class="close-x" onclick="cerrarModalConfigQR()">&times;</button>
        </div>
        <div class="form-group">
            <label>Número Yape / Plin / Cuenta</label>
            <input type="text" id="cfg-numero" value="968 752 081">
        </div>
        <div class="form-group">
            <label>Subir Imagen de tu propio QR (Yape/Plin)</label>
            <label class="file-upload-label">
                📤 Seleccionar Imagen QR desde tu PC
                <input type="file" accept="image/*" style="display:none;" onchange="subirNuevoQRAdmin(event)">
            </label>
        </div>
        <button class="btn-add-cart" style="width:100%; padding:12px;" onclick="guardarConfigQR()">💾 Guardar Configuración QR</button>
    </div>
</div>

<!-- Contenedor de Notificaciones Toast -->
<div class="toast-container" id="toast-container"></div>

<script>
/* ==========================================================================
   ESTADO GLOBAL Y UTILIDADES
   ========================================================================== */
let catalogo = [];
let categoriaActual = '';
let carrito = JSON.parse(localStorage.getItem('rincon_carrito_v7') || '[]');
let imagenTemporalProducto = '';
let ultimaOrdenDatos = null;

// Imagen elegante por defecto y mapeo inteligente por nombre
const DEFAULT_FOOD_IMG = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=700&q=80';

function resolverImagenPlato(p) {
    if (p.imagen && p.imagen.trim() !== '') return p.imagen;
    const n = (p.nombre || '').toLowerCase();
    if (n.includes('huanca') || n.includes('papa')) return 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?auto=format&fit=crop&w=700&q=80';
    if (n.includes('ceviche') || n.includes('cebiche')) return 'https://images.unsplash.com/photo-1535399831218-d5bd36d1a6b3?auto=format&fit=crop&w=700&q=80';
    if (n.includes('causa')) return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80';
    if (n.includes('anticucho') || n.includes('parrilla')) return 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=700&q=80';
    if (n.includes('lomo')) return 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=700&q=80';
    if (n.includes('trucha') || n.includes('pescado')) return 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&w=700&q=80';
    if (n.includes('marisco') || n.includes('jalea')) return 'https://images.unsplash.com/photo-1534080564583-6be75777b70a?auto=format&fit=crop&w=700&q=80';
    if (n.includes('gallina') || n.includes('pollo')) return 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=700&q=80';
    if (n.includes('chicha')) return 'https://images.unsplash.com/photo-1556881286-fc6915169721?auto=format&fit=crop&w=700&q=80';
    if (n.includes('pisco') || n.includes('sour')) return 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=700&q=80';
    if (n.includes('limonada') || p.categoria === 'Bebidas') return 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=700&q=80';
    return DEFAULT_FOOD_IMG;
}

function mostrarToast(mensaje, icono = '✨') {
    const cont = document.getElementById('toast-container');
    const div = document.createElement('div');
    div.className = 'toast';
    div.innerHTML = `<span>${icono}</span> <span>${mensaje}</span>`;
    cont.appendChild(div);
    setTimeout(() => div.remove(), 3400);
}

/* ==========================================================================
   MODO OSCURO / CLARO
   ========================================================================== */
function toggleTheme() {
    const html = document.documentElement;
    const actual = html.getAttribute('data-theme');
    const nuevo = actual === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', nuevo);
    localStorage.setItem('rincon_theme', nuevo);
    document.getElementById('btn-theme').textContent = nuevo === 'dark' ? '☀️ Modo Claro' : '🌙 Modo Oscuro';
}
(function initTheme() {
    const guardado = localStorage.getItem('rincon_theme') || 'dark';
    document.documentElement.setAttribute('data-theme', guardado);
    document.getElementById('btn-theme').textContent = guardado === 'dark' ? '☀️ Modo Claro' : '🌙 Modo Oscuro';
})();

/* ==========================================================================
   CARGA Y RENDERIZADO DEL CATÁLOGO
   ========================================================================== */
async function cargarCatalogo() {
    const res = await fetch('controllers/carta.php');
    const json = await res.json();
    catalogo = json.data || [];
    filtrarCatalogo();
    renderizarCarrito();
}

function seleccionarCategoria(cat, btn) {
    categoriaActual = cat;
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    filtrarCatalogo();
}

function filtrarCatalogo() {
    const q = document.getElementById('buscador').value.toLowerCase().trim();
    const filtrados = catalogo.filter(p => {
        const coincideTexto = p.nombre.toLowerCase().includes(q) ||
                              p.codigo.toLowerCase().includes(q) ||
                              (p.descripcion || '').toLowerCase().includes(q);
        const coincideCat = categoriaActual === '' || p.categoria === categoriaActual;
        return coincideTexto && coincideCat;
    });
    renderizarGrid(filtrados);
}

function renderizarGrid(lista) {
    const grid = document.getElementById('catalogo-grid');
    grid.innerHTML = '';

    if (lista.length === 0) {
        grid.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:40px; color:var(--text-secondary);">No se encontraron productos con ese criterio.</div>`;
        return;
    }

    lista.forEach(p => {
        const foto = resolverImagenPlato(p);
        const disponible = p.condicion == 1 && p.stock > 0;
        const lowStock = p.stock <= 5 ? 'low' : '';

        grid.innerHTML += `
            <article class="product-card" style="opacity:${disponible ? '1' : '0.6'}">
                <div class="card-img-wrap">
                    <img src="${foto}" alt="${p.nombre}" onerror="this.src='${DEFAULT_FOOD_IMG}'">
                    <span class="card-cat-pill">${p.categoria}</span>
                    <div class="card-admin-btns">
                        <button class="icon-btn" title="Editar producto e imagen" onclick="abrirModalProducto(${p.idplato})">✏️</button>
                        <button class="icon-btn del" title="Eliminar producto" onclick="eliminarProducto(${p.idplato}, '${p.nombre.replace(/'/g, "\\'")}')">🗑️</button>
                    </div>
                    <span class="card-price-badge">S/ ${parseFloat(p.precio).toFixed(2)}</span>
                </div>
                <div class="card-body">
                    <div>
                        <span class="card-code">${p.codigo}</span>
                        <h4 class="card-title">${p.nombre}</h4>
                        <p class="card-desc">${p.descripcion || 'Especialidad gourmet preparada al instante.'}</p>
                    </div>
                    <div class="card-footer">
                        <span class="stock-tag ${lowStock}">${disponible ? `🔥 ${p.stock} disp.` : '⛔ Agotado'}</span>
                        <button class="btn-add-cart" ${!disponible ? 'disabled' : ''} onclick="agregarAlCarrito(${p.idplato})">
                            🛒 Agregar
                        </button>
                    </div>
                </div>
            </article>
        `;
    });
}

/* ==========================================================================
   CARRITO LATERAL DESLIZABLE (DRAWER)
   ========================================================================== */
function toggleCart(abrir) {
    document.getElementById('drawer-overlay').classList.toggle('open', abrir);
    document.getElementById('cart-drawer').classList.toggle('open', abrir);
}

function agregarAlCarrito(idplato) {
    const prod = catalogo.find(p => p.idplato == idplato);
    if (!prod) return;

    const item = carrito.find(i => i.idplato == idplato);
    if (item) {
        if (item.cantidad + 1 > prod.stock) {
            mostrarToast('Stock máximo alcanzado para este plato', '⚠️');
            return;
        }
        item.cantidad++;
    } else {
        carrito.push({
            idplato: prod.idplato,
            nombre: prod.nombre,
            precio: parseFloat(prod.precio),
            imagen: resolverImagenPlato(prod),
            cantidad: 1,
            stockMax: parseInt(prod.stock)
        });
    }
    guardarYRenderizarCarrito();
    mostrarToast(`${prod.nombre} agregado al carrito`, '🛒');
}

function cambiarCantidad(idplato, delta) {
    const idx = carrito.findIndex(i => i.idplato == idplato);
    if (idx === -1) return;
    const nuevo = carrito[idx].cantidad + delta;
    if (nuevo <= 0) {
        carrito.splice(idx, 1);
    } else if (nuevo <= carrito[idx].stockMax) {
        carrito[idx].cantidad = nuevo;
    } else {
        mostrarToast('No hay más unidades en stock', '⚠️');
    }
    guardarYRenderizarCarrito();
}

function guardarYRenderizarCarrito() {
    localStorage.setItem('rincon_carrito_v7', JSON.stringify(carrito));
    renderizarCarrito();
}

function renderizarCarrito() {
    const cont = document.getElementById('cart-items-container');
    const badge = document.getElementById('cart-badge');
    let total = 0;
    let totalItems = 0;

    if (carrito.length === 0) {
        cont.innerHTML = `<div style="text-align:center; padding:50px 10px; color:var(--text-secondary);">Tu carrito está vacío.<br>Agrega especialidades desde la carta.</div>`;
        badge.textContent = '0';
        document.getElementById('cart-subtotal').textContent = 'S/ 0.00';
        document.getElementById('cart-total').textContent = 'S/ 0.00';
        return;
    }

    cont.innerHTML = '';
    carrito.forEach(item => {
        const sub = item.precio * item.cantidad;
        total += sub;
        totalItems += item.cantidad;
        cont.innerHTML += `
            <div class="cart-item">
                <img src="${item.imagen}" alt="${item.nombre}" onerror="this.src='${DEFAULT_FOOD_IMG}'">
                <div class="cart-item-info">
                    <div class="cart-item-title">${item.nombre}</div>
                    <div class="cart-item-price">S/ ${sub.toFixed(2)} (S/ ${item.precio.toFixed(2)} c/u)</div>
                </div>
                <div class="qty-controls">
                    <button class="qty-btn" onclick="cambiarCantidad(${item.idplato}, -1)">-</button>
                    <span style="font-weight:800; min-width:20px; text-align:center;">${item.cantidad}</span>
                    <button class="qty-btn" onclick="cambiarCantidad(${item.idplato}, 1)">+</button>
                </div>
            </div>
        `;
    });

    badge.textContent = totalItems;
    document.getElementById('cart-subtotal').textContent = `S/ ${total.toFixed(2)}`;
    document.getElementById('cart-total').textContent = `S/ ${total.toFixed(2)}`;
}

/* ==========================================================================
   GESTIÓN CRUD DE PRODUCTOS E IMÁGENES EN TIEMPO REAL
   ========================================================================== */
function abrirModalProducto(idplato = null) {
    const form = document.getElementById('form-producto');
    form.reset();
    document.getElementById('prod-id').value = '';
    imagenTemporalProducto = '';

    if (idplato) {
        const p = catalogo.find(item => item.idplato == idplato);
        if (!p) return;
        document.getElementById('modal-prod-titulo').textContent = '✏️ Editar Producto e Imagen';
        document.getElementById('prod-id').value = p.idplato;
        document.getElementById('prod-categoria').value = p.idcategoria;
        document.getElementById('prod-codigo').value = p.codigo;
        document.getElementById('prod-nombre').value = p.nombre;
        document.getElementById('prod-precio').value = p.precio;
        document.getElementById('prod-stock').value = p.stock;
        document.getElementById('prod-condicion').value = p.condicion;
        document.getElementById('prod-descripcion').value = p.descripcion || '';
        imagenTemporalProducto = resolverImagenPlato(p);
        document.getElementById('prod-imagen-url').value = (p.imagen && !p.imagen.startsWith('data:')) ? p.imagen : '';
    } else {
        document.getElementById('modal-prod-titulo').textContent = '✨ Agregar Nuevo Producto';
        document.getElementById('prod-codigo').value = 'PLT-0' + (catalogo.length + 1);
    }

    actualizarVistaPrevia();
    document.getElementById('modal-producto').classList.add('open');
}

function cerrarModalProducto() {
    document.getElementById('modal-producto').classList.remove('open');
}

function procesarArchivoImagen(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(evt) {
        imagenTemporalProducto = evt.target.result;
        document.getElementById('prev-img').src = imagenTemporalProducto;
        mostrarToast('Imagen cargada en vista previa', '🖼️');
    };
    reader.readAsDataURL(file);
}

function actualizarImagenDesdeURL() {
    const url = document.getElementById('prod-imagen-url').value.trim();
    if (url) {
        imagenTemporalProducto = url;
        document.getElementById('prev-img').src = url;
    }
}

function actualizarVistaPrevia() {
    const selCat = document.getElementById('prod-categoria');
    const catNombre = selCat.options[selCat.selectedIndex].getAttribute('data-nombre');
    const codigo = document.getElementById('prod-codigo').value || 'PLT-000';
    const nombre = document.getElementById('prod-nombre').value || 'Nombre del Producto';
    const precio = parseFloat(document.getElementById('prod-precio').value) || 0;
    const stock = document.getElementById('prod-stock').value || 0;
    const desc = document.getElementById('prod-descripcion').value || 'Descripción gourmet del plato...';

    document.getElementById('prev-cat').textContent = catNombre;
    document.getElementById('prev-codigo').textContent = codigo;
    document.getElementById('prev-nombre').textContent = nombre;
    document.getElementById('prev-precio').textContent = `S/ ${precio.toFixed(2)}`;
    document.getElementById('prev-stock').textContent = `🔥 ${stock} disp.`;
    document.getElementById('prev-desc').textContent = desc;

    const imgPreview = imagenTemporalProducto || resolverImagenPlato({ nombre, categoria: catNombre });
    document.getElementById('prev-img').src = imgPreview;
}

document.getElementById('form-producto').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('prod-id').value;
    const payload = {
        idcategoria: document.getElementById('prod-categoria').value,
        codigo: document.getElementById('prod-codigo').value.trim(),
        nombre: document.getElementById('prod-nombre').value.trim(),
        precio: parseFloat(document.getElementById('prod-precio').value),
        stock: parseInt(document.getElementById('prod-stock').value),
        descripcion: document.getElementById('prod-descripcion').value.trim(),
        condicion: parseInt(document.getElementById('prod-condicion').value),
        imagen: imagenTemporalProducto || null
    };

    const url = id ? `controllers/carta.php?id=${id}` : 'controllers/carta.php';
    const metodo = id ? 'PUT' : 'POST';

    const res = await fetch(url, {
        method: metodo,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });
    const json = await res.json();
    if (json.status === 'success') {
        cerrarModalProducto();
        mostrarToast(id ? 'Producto actualizado correctamente' : 'Nuevo producto publicado', '✅');
        cargarCatalogo();
    } else {
        mostrarToast(json.message || 'Error al guardar', '❌');
    }
});

async function eliminarProducto(id, nombre) {
    if (!confirm(`¿Deseas eliminar "${nombre}" del catálogo?`)) return;
    const res = await fetch(`controllers/carta.php?id=${id}`, { method: 'DELETE' });
    const json = await res.json();
    if (json.status === 'success') {
        mostrarToast('Producto eliminado del catálogo', '🗑️');
        cargarCatalogo();
    }
}

/* ==========================================================================
   CHECKOUT INTERACTIVO CON CÓDIGO QR Y CONFIGURACIÓN QR
   ========================================================================== */
function obtenerImagenQRActual(monto) {
    const qrCustom = localStorage.getItem('rincon_qr_img_v7');
    if (qrCustom) return qrCustom;
    const num = localStorage.getItem('rincon_qr_num_v7') || '968 752 081';
    const dataQR = encodeURIComponent(`EL RINCON DEL SABOR | YAPE/PLIN: ${num} | MONTO: S/ ${monto.toFixed(2)}`);
    return `https://api.qrserver.com/v1/create-qr-code/?size=240x240&margin=8&data=${dataQR}`;
}

function abrirModalCheckoutQR() {
    if (carrito.length === 0) {
        mostrarToast('Agrega productos al carrito primero', '⚠️');
        return;
    }
    toggleCart(false);
    const total = carrito.reduce((acc, i) => acc + (i.precio * i.cantidad), 0);
    const numGuardado = localStorage.getItem('rincon_qr_num_v7') || '968 752 081';

    document.getElementById('qr-monto-total').textContent = `S/ ${total.toFixed(2)}`;
    document.getElementById('qr-numero-texto').textContent = numGuardado;
    document.getElementById('checkout-qr-img').src = obtenerImagenQRActual(total);

    document.getElementById('checkout-form-view').style.display = 'grid';
    document.getElementById('checkout-success-view').style.display = 'none';
    document.getElementById('modal-checkout-qr').classList.add('open');
}

function cerrarModalCheckoutQR() {
    document.getElementById('modal-checkout-qr').classList.remove('open');
}

function copiarNumeroCuenta() {
    const num = (localStorage.getItem('rincon_qr_num_v7') || '968752081').replace(/\s+/g, '');
    navigator.clipboard.writeText(num);
    mostrarToast(`Número ${num} copiado al portapapeles`, '📋');
}

function descargarImagenQR() {
    const link = document.createElement('a');
    link.href = document.getElementById('checkout-qr-img').src;
    link.download = 'QR-Pago-ElRinconDelSabor.png';
    link.target = '_blank';
    link.click();
    mostrarToast('Descargando código QR de pago...', '⬇️');
}

function mostrarNombreCaptura(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('captura-nombre').textContent = `✅ Comprobante adjunto: ${file.name}`;
        if (!document.getElementById('chk-operacion').value) {
            document.getElementById('chk-operacion').value = `Archivo: ${file.name}`;
        }
    }
}

document.getElementById('form-confirmar-pago').addEventListener('submit', async function(e) {
    e.preventDefault();
    const cliente = document.getElementById('chk-cliente').value.trim();
    const mesa = document.getElementById('chk-mesa').value;
    const metodo_pago = document.getElementById('chk-metodo').value;
    const comprobante = document.getElementById('chk-operacion').value.trim();
    const total = carrito.reduce((acc, i) => acc + (i.precio * i.cantidad), 0);

    const res = await fetch('controllers/pedidos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, cliente, metodo_pago, comprobante, items: carrito })
    });
    const json = await res.json();

    if (json.status === 'success') {
        ultimaOrdenDatos = {
            orden: json.orden_codigo,
            cliente, mesa, metodo_pago, comprobante, total,
            items: [...carrito]
        };
        document.getElementById('orden-generada-codigo').textContent = json.orden_codigo;
        document.getElementById('checkout-form-view').style.display = 'none';
        document.getElementById('checkout-success-view').style.display = 'block';

        carrito = [];
        guardarYRenderizarCarrito();
        cargarCatalogo();
        mostrarToast('¡Pedido verificado y registrado con éxito!', '🎉');
    } else {
        mostrarToast(json.message || 'Error al procesar el pago', '❌');
    }
});

function enviarComprobanteWhatsApp() {
    if (!ultimaOrdenDatos) return;
    let lista = '';
    ultimaOrdenDatos.items.forEach(i => {
        lista += `• ${i.cantidad}x ${i.nombre} (S/ ${(i.precio * i.cantidad).toFixed(2)})\n`;
    });
    const msg = encodeURIComponent(
        `🍽️ *ORDEN CONFIRMADA ${ultimaOrdenDatos.orden} — EL RINCÓN DEL SABOR*\n` +
        `👤 *Cliente:* ${ultimaOrdenDatos.cliente}\n` +
        `📍 *Modalidad:* ${ultimaOrdenDatos.mesa}\n` +
        `💳 *Método Pago:* ${ultimaOrdenDatos.metodo_pago}\n` +
        `🧾 *Comprobante:* ${ultimaOrdenDatos.comprobante}\n\n` +
        `*DETALLE:*\n${lista}\n` +
        `💰 *TOTAL PAGADO: S/ ${ultimaOrdenDatos.total.toFixed(2)}*`
    );
    window.open(`https://wa.me/51968752081?text=${msg}`, '_blank');
}

/* Configuración Admin del QR */
let qrTempAdmin = '';
function abrirModalConfigQR() {
    document.getElementById('cfg-numero').value = localStorage.getItem('rincon_qr_num_v7') || '968 752 081';
    document.getElementById('modal-config-qr').classList.add('open');
}
function cerrarModalConfigQR() { document.getElementById('modal-config-qr').classList.remove('open'); }
function subirNuevoQRAdmin(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = evt => { qrTempAdmin = evt.target.result; mostrarToast('Imagen QR lista para guardar', '📷'); };
    reader.readAsDataURL(file);
}
function guardarConfigQR() {
    const num = document.getElementById('cfg-numero').value.trim();
    localStorage.setItem('rincon_qr_num_v7', num);
    if (qrTempAdmin) localStorage.setItem('rincon_qr_img_v7', qrTempAdmin);
    cerrarModalConfigQR();
    mostrarToast('Configuración de QR actualizada', '✅');
}

cargarCatalogo();
</script>
</body>
</html>