<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Sabor | Pedidos Online &amp; Gestión v7.0</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root[data-theme="dark"] {
            --bg-body: #0f0a07;
            --bg-surface: #1b120c;
            --bg-card: #22160f;
            --bg-glass: rgba(27, 18, 12, 0.86);
            --text-primary: #fdf8f2;
            --text-secondary: #c2b2a3;
            --border-color: rgba(212, 175, 55, 0.28);
            --input-bg: #140c08;
            --shadow-card: 0 14px 34px rgba(0, 0, 0, 0.48);
        }
        :root[data-theme="light"] {
            --bg-body: #faf6f0;
            --bg-surface: #ffffff;
            --bg-card: #ffffff;
            --bg-glass: rgba(255, 255, 255, 0.90);
            --text-primary: #24150d;
            --text-secondary: #6e5a4f;
            --border-color: rgba(212, 175, 55, 0.42);
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
            --yape-dark: #4a1259;
            --wsp: #25D366;
            --radius-xl: 18px;
        }

        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; transition: background-color 0.2s ease, color 0.2s ease; }
        body { margin: 0; background-color: var(--bg-body); color: var(--text-primary); overflow-x: hidden; }

        /* Visibilidad según Rol (Cliente vs Personal Autenticado) */
        body[data-role="cliente"] .staff-only { display: none !important; }
        body[data-role="staff"] .client-only-login { display: none !important; }

        /* NAVBAR GLASSMORPHISM */
        header {
            position: sticky; top: 0; z-index: 1000;
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            border-bottom: 1.5px solid var(--border-color);
            padding: 12px 34px;
            display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap;
        }
        .brand { display: flex; align-items: center; gap: 14px; text-decoration: none; }
        .brand-logo {
            width: 58px !important; height: 58px !important;
            border-radius: 50%; border: 2px solid var(--gold);
            object-fit: cover; box-shadow: 0 0 16px rgba(212, 175, 55, 0.45);
        }
        .brand-title h1 {
            font-family: 'Playfair Display', serif; font-size: 23px; margin: 0;
            background: linear-gradient(90deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-title span { font-size: 11px; letter-spacing: 1.8px; text-transform: uppercase; color: var(--text-secondary); display: block; }

        /* Selector de Modo Cliente / Personal */
        .role-switcher {
            display: flex; align-items: center; gap: 8px;
            background: var(--input-bg); padding: 5px; border-radius: 40px;
            border: 1px solid var(--border-color);
        }
        .role-tab {
            padding: 8px 16px; border-radius: 30px; border: none;
            font-weight: 700; font-size: 13px; cursor: pointer;
            background: transparent; color: var(--text-secondary);
            display: flex; align-items: center; gap: 6px;
        }
        .role-tab.active {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #140c07; font-weight: 800; box-shadow: 0 4px 12px rgba(212,175,55,0.3);
        }
        .role-tab.staff-active {
            background: linear-gradient(135deg, var(--crimson), #dc2626);
            color: #fff; font-weight: 800;
        }

        .nav-actions { display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }
        .nav-link {
            color: var(--text-primary); text-decoration: none; font-weight: 600; font-size: 13px;
            padding: 9px 15px; border-radius: 30px; border: 1px solid var(--border-color);
            background: rgba(212, 175, 55, 0.06); cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
        }
        .nav-link:hover, .nav-link.active {
            border-color: var(--gold); background: rgba(212, 175, 55, 0.2);
        }

        .btn-cart-trigger {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #140c07; font-weight: 800; border: none; padding: 10px 18px;
            border-radius: 30px; cursor: pointer; display: flex; align-items: center; gap: 8px;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.35); font-size: 13.5px;
        }
        .cart-counter {
            background: var(--crimson); color: #fff; font-size: 12px; font-weight: 800;
            padding: 2px 8px; border-radius: 20px;
        }

        /* Franja Superior de Estado de Sesión Staff */
        .staff-bar {
            background: linear-gradient(90deg, #7f1d1d, #24150d, #7f1d1d);
            color: #fff; padding: 9px 34px; font-size: 13px;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;
            border-bottom: 1px solid var(--gold);
        }

        /* HERO BANNER */
        .hero {
            background: linear-gradient(rgba(15, 10, 7, 0.72), rgba(15, 10, 7, 0.9)),
                        url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1500&q=80') center/cover;
            padding: 38px 24px; text-align: center; border-bottom: 1.5px solid var(--border-color);
        }
        .hero h2 { font-family: 'Playfair Display', serif; font-size: 34px; margin: 0 0 8px; color: var(--gold-light); }
        .hero p { max-width: 660px; margin: 0 auto 16px; color: #e5d8c8; font-size: 14.5px; }
        .hero-badges { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; }
        .hero-pill {
            background: rgba(255,255,255,0.1); backdrop-filter: blur(8px);
            border: 1px solid rgba(212, 175, 55, 0.4); color: #fff;
            padding: 6px 14px; border-radius: 30px; font-size: 12px; font-weight: 600;
        }

        .container { max-width: 1320px; margin: 26px auto; padding: 0 24px; }

        .toolbar {
            background: var(--bg-surface); border: 1px solid var(--border-color);
            border-radius: var(--radius-xl); padding: 16px 22px; margin-bottom: 26px;
            display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap;
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
            color: #fff; border: 1px solid var(--gold); padding: 10px 18px;
            border-radius: 30px; font-weight: 800; font-size: 13px; cursor: pointer;
        }

        /* TARJETAS DE PRODUCTOS */
        .catalog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; }
        .product-card {
            background: var(--bg-card); border-radius: var(--radius-xl);
            border: 1px solid var(--border-color); overflow: hidden;
            box-shadow: var(--shadow-card); display: flex; flex-direction: column;
            transition: transform 0.28s ease, box-shadow 0.28s ease;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 38px rgba(212, 175, 55, 0.16);
            border-color: var(--gold);
        }
        .card-img-wrap { position: relative; height: 210px; width: 100%; overflow: hidden; background: #160d08; }
        .card-img-wrap img { width: 100% !important; height: 210px !important; object-fit: cover; transition: transform 0.45s ease; }
        .product-card:hover .card-img-wrap img { transform: scale(1.07); }

        .card-cat-pill {
            position: absolute; top: 12px; left: 12px;
            background: rgba(15, 10, 7, 0.84); backdrop-filter: blur(6px);
            color: var(--gold-light); border: 1px solid var(--gold);
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;
        }
        .card-admin-btns { position: absolute; top: 12px; right: 12px; display: flex; gap: 6px; }
        .icon-btn {
            width: 34px; height: 34px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.3);
            background: rgba(15, 10, 7, 0.82); color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }
        .icon-btn:hover { background: var(--gold); color: #140c07; }
        .icon-btn.del:hover { background: var(--crimson-light); color: #fff; }

        .card-price-badge {
            position: absolute; bottom: 12px; right: 12px;
            background: linear-gradient(135deg, var(--crimson), #991b1b);
            color: #fff; padding: 6px 14px; border-radius: 10px;
            font-weight: 800; font-size: 16px; border: 1px solid rgba(255,255,255,0.25);
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

        /* DRAWER DEL CARRITO */
        .drawer-overlay {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(4px); z-index: 2000; display: none;
        }
        .drawer-overlay.open { display: block; }
        .cart-drawer {
            position: fixed; top: 0; right: -430px; width: 410px; max-width: 92vw; height: 100vh;
            background: var(--bg-surface); border-left: 2px solid var(--gold);
            z-index: 2001; display: flex; flex-direction: column;
            box-shadow: -10px 0 35px rgba(0,0,0,0.5); transition: right 0.3s ease;
        }
        .cart-drawer.open { right: 0; }
        .drawer-header { padding: 20px 22px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .drawer-header h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 22px; color: var(--gold); }
        .drawer-body { flex: 1; overflow-y: auto; padding: 18px 22px; }
        .cart-item {
            display: flex; align-items: center; gap: 12px; padding: 12px;
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 12px; margin-bottom: 12px;
        }
        .cart-item img { width: 56px; height: 56px; border-radius: 10px; object-fit: cover; border: 1px solid var(--gold); }
        .cart-item-info { flex: 1; }
        .cart-item-title { font-weight: 700; font-size: 14px; margin-bottom: 4px; }
        .cart-item-price { color: var(--gold); font-weight: 800; font-size: 13px; }
        .qty-controls { display: flex; align-items: center; gap: 6px; }
        .qty-btn {
            width: 28px; height: 28px; border-radius: 8px; border: 1px solid var(--border-color);
            background: var(--input-bg); color: var(--text-primary); font-weight: 800; cursor: pointer;
        }
        .drawer-footer { padding: 20px 22px; border-top: 1px solid var(--border-color); background: var(--bg-card); }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; color: var(--text-secondary); }
        .summary-total {
            display: flex; justify-content: space-between; font-size: 20px; font-weight: 800;
            color: var(--gold-light); padding-top: 10px; border-top: 1px dashed var(--border-color); margin-bottom: 16px;
        }
        .btn-checkout-qr {
            width: 100%; padding: 14px; border-radius: 12px; border: none;
            background: linear-gradient(135deg, var(--emerald), #059669);
            color: #fff; font-weight: 800; font-size: 15px; cursor: pointer;
        }

        /* MODALES */
        .modal-backdrop {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.78);
            backdrop-filter: blur(8px); z-index: 3000; display: none;
            align-items: center; justify-content: center; padding: 16px; overflow-y: auto;
        }
        .modal-backdrop.open { display: flex; }
        .modal-window {
            background: var(--bg-surface); border: 1.5px solid var(--gold);
            border-radius: var(--radius-xl); width: 100%; max-width: 860px;
            padding: 26px; box-shadow: 0 25px 60px rgba(0,0,0,0.65); max-height: 94vh; overflow-y: auto;
        }
        .modal-header {
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid var(--border-color); padding-bottom: 14px; margin-bottom: 20px;
        }
        .modal-header h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 22px; color: var(--gold); }
        .close-x { background: none; border: none; color: var(--text-secondary); font-size: 26px; cursor: pointer; }

        .crud-split { display: grid; grid-template-columns: 1.3fr 1fr; gap: 24px; align-items: start; }
        @media (max-width: 780px) { .crud-split { grid-template-columns: 1fr; } }

        .form-group { margin-bottom: 14px; display: flex; flex-direction: column; }
        .form-group label { font-size: 11.5px; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: var(--text-secondary); }
        .form-group input, .form-group select {
            padding: 11px 14px; border-radius: 10px; border: 1.5px solid var(--border-color);
            background: var(--input-bg); color: var(--text-primary); font-size: 14px; outline: none;
        }
        .file-upload-label {
            border: 1.5px dashed var(--gold); border-radius: 10px; padding: 11px;
            text-align: center; cursor: pointer; background: rgba(212, 175, 55, 0.07);
            font-size: 13px; font-weight: 600; color: var(--gold-light);
        }

        /* TARJETA DE PAGO YAPE OFICIAL */
        .qr-checkout-grid { display: grid; grid-template-columns: 1fr 1.15fr; gap: 24px; align-items: center; }
        @media (max-width: 760px) { .qr-checkout-grid { grid-template-columns: 1fr; } }

        .qr-display-card {
            background: linear-gradient(160deg, #742284 0%, #4a1259 100%);
            border: 2px solid var(--gold); border-radius: 20px; padding: 20px;
            text-align: center; color: #fff; box-shadow: 0 14px 34px rgba(116, 34, 132, 0.55);
        }
        .qr-frame {
            background: #ffffff; padding: 10px; border-radius: 16px; display: inline-block;
            margin: 10px auto; box-shadow: 0 8px 24px rgba(0,0,0,0.35);
        }
        .qr-frame img {
            width: 230px !important; height: 260px !important;
            object-fit: contain; display: block; border-radius: 10px;
        }
        .qr-amount-pill {
            background: var(--gold); color: #140c07; font-weight: 800; font-size: 21px;
            padding: 6px 20px; border-radius: 30px; display: inline-block; margin-top: 6px;
        }
        .qr-actions { display: flex; gap: 8px; justify-content: center; margin-top: 12px; flex-wrap: wrap; }
        .btn-qr-tool {
            background: rgba(255,255,255,0.16); color: #fff; border: 1px solid rgba(255,255,255,0.35);
            padding: 8px 13px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;
        }
        .btn-qr-tool:hover { background: var(--gold); color: #140c07; }

        /* TOAST */
        .toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 5000; display: flex; flex-direction: column; gap: 10px; }
        .toast {
            background: var(--bg-surface); color: var(--text-primary);
            border-left: 5px solid var(--gold); border: 1px solid var(--border-color);
            padding: 14px 20px; border-radius: 12px; font-weight: 700; font-size: 13.5px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.45); display: flex; align-items: center; gap: 10px;
        }
    </style>
</head>
<body data-role="cliente">

<!-- FRANJA DE PERSONAL AUTENTICADO (SOLO VISIBLE CUANDO INICIA SESIÓN EL MOZO / ADMIN) -->
<div class="staff-bar staff-only">
    <div>
        🔐 <strong>Modo Personal Activo:</strong> <span id="staff-nombre-activo">Midward Quispe Mamani (Administrador)</span> — Tienes control total para agregar/editar productos, ver caja y configurar el QR.
    </div>
    <button onclick="cerrarSesionStaff()" style="background:#fff; color:#7f1d1d; border:none; padding:5px 14px; border-radius:20px; font-weight:800; font-size:12px; cursor:pointer;">
        🚪 Cerrar Sesión y Volver a Vista Cliente
    </button>
</div>

<!-- NAVBAR PRINCIPAL -->
<header>
    <a href="index.php" class="brand">
        <img src="assets/img/logo.jpg" alt="Logo" class="brand-logo" onerror="this.src='https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=200&q=80'">
        <div class="brand-title">
            <h1>El Rincón del Sabor</h1>
            <span>Alta Cocina Peruana &amp; Pedidos Online</span>
        </div>
    </a>

    <!-- Selector claro: Zona Cliente vs Acceso Mozo/Admin -->
    <div class="role-switcher">
        <button id="tab-cliente" class="role-tab active" onclick="activarVistaCliente()">
            👤 Zona Cliente (Pedir)
        </button>
        <button id="tab-staff" class="role-tab" onclick="intentarAccesoStaff()">
            🔐 Mozo / Administrador
        </button>
    </div>

    <div class="nav-actions">
        <!-- Opciones exclusivas para Mozo / Administrador -->
        <a href="pedidos.php" class="nav-link staff-only">🧾 Comandas Salón</a>
        <a href="reportes.php" class="nav-link staff-only">📊 Caja y Reportes</a>
        <button class="nav-link staff-only" onclick="abrirModalConfigQR()">⚙️ Subir/Cambiar QR</button>

        <!-- Opciones disponibles para todos -->
        <button class="nav-link" onclick="toggleTheme()" id="btn-theme">☀️ Claro</button>
        <button class="btn-cart-trigger" onclick="toggleCart(true)">
            🛒 Mi Pedido <span class="cart-counter" id="cart-badge">0</span>
        </button>
    </div>
</header>

<!-- HERO BANNER -->
<section class="hero">
    <h2>Bienvenido a El Rincón del Sabor</h2>
    <p>Elige tus platos peruanos favoritos en nuestra carta digital y realiza tu pago al instante escaneando nuestro código QR oficial de Yape.</p>
    <div class="hero-badges">
        <span class="hero-pill">📱 Yape Oficial: Midward Quispe Mamani (968 752 081)</span>
        <span class="hero-pill">🍽️ Atención en Salón y Pedidos Para Llevar</span>
    </div>
</section>

<!-- CONTENIDO PRINCIPAL -->
<div class="container">
    <div class="toolbar">
        <div class="search-box">
            <span class="search-icon">🔍</span>
            <input type="text" id="buscador" placeholder="Buscar plato por nombre o ingrediente..." oninput="filtrarCatalogo()">
        </div>

        <div class="category-tabs">
            <button class="cat-btn active" onclick="seleccionarCategoria('', this)">Todos</button>
            <button class="cat-btn" onclick="seleccionarCategoria('Entradas', this)">🥗 Entradas</button>
            <button class="cat-btn" onclick="seleccionarCategoria('Platos de Fondo', this)">🍛 Platos de Fondo</button>
            <button class="cat-btn" onclick="seleccionarCategoria('Bebidas', this)">🍹 Bebidas</button>
        </div>

        <!-- Botón exclusivo de Administrador/Mozo -->
        <button class="btn-primary-gradient staff-only" onclick="abrirModalProducto()">+ Nuevo Producto</button>
    </div>

    <!-- Galería de Productos -->
    <div id="catalogo-grid" class="catalog-grid"></div>
</div>

<!-- DRAWER LATERAL DEL CARRITO -->
<div id="drawer-overlay" class="drawer-overlay" onclick="toggleCart(false)"></div>
<aside id="cart-drawer" class="cart-drawer">
    <div class="drawer-header">
        <h3>🛒 Tu Pedido Actual</h3>
        <button class="close-x" onclick="toggleCart(false)">&times;</button>
    </div>
    <div class="drawer-body" id="cart-items-container"></div>
    <div class="drawer-footer">
        <div class="summary-row">
            <span>Subtotal</span>
            <span id="cart-subtotal">S/ 0.00</span>
        </div>
        <div class="summary-total">
            <span>Total a Pagar:</span>
            <span id="cart-total">S/ 0.00</span>
        </div>
        <button class="btn-checkout-qr" onclick="abrirModalCheckoutQR()">
            📲 Pagar Ahora con QR Yape / Efectivo
        </button>
    </div>
</aside>

<!-- ================= MODAL LOGIN PARA MOZO / ADMINISTRADOR ================= -->
<div id="modal-login" class="modal-backdrop">
    <div class="modal-window" style="max-width: 420px;">
        <div class="modal-header">
            <h3>🔐 Acceso Personal Autorizado</h3>
            <button class="close-x" onclick="cerrarModalLogin()">&times;</button>
        </div>
        <p style="font-size:13px; color:var(--text-secondary); margin-top:0;">
            Ingresa tus credenciales de <strong>Administrador</strong> o <strong>Mozo</strong> para gestionar la carta, precios, stock y comandas.
        </p>
        <form id="form-login">
            <div class="form-group">
                <label>Rol / Usuario</label>
                <select id="login-user">
                    <option value="Midward Quispe Mamani (Administrador)">👑 Midward Quispe (Administrador)</option>
                    <option value="Mozo de Salón (Atención)">🤵 Mozo de Salón</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contraseña de Acceso (PIN)</label>
                <input type="password" id="login-pass" placeholder="Ingresa 1234" required>
                <small style="color:var(--gold); margin-top:4px;">💡 Clave de acceso: <strong>1234</strong></small>
            </div>
            <button type="submit" class="btn-add-cart" style="width:100%; padding:13px; font-size:14px;">
                🔓 Ingresar al Panel de Gestión
            </button>
        </form>
    </div>
</div>

<!-- ================= MODAL CHECKOUT DE PAGO RÁPIDO CON TU QR DE YAPE OFICIAL ================= -->
<div id="modal-checkout-qr" class="modal-backdrop">
    <div class="modal-window" style="max-width: 840px;">
        <div class="modal-header">
            <h3>📲 Finalizar Compra — Pago Rápido con Código QR Oficial</h3>
            <button class="close-x" onclick="cerrarModalCheckoutQR()">&times;</button>
        </div>

        <div id="checkout-form-view" class="qr-checkout-grid">
            <!-- Tarjeta Izquierda: QR Real de Yape de Midward Quispe Mamani -->
            <div class="qr-display-card">
                <div style="font-size:12px; font-weight:800; letter-spacing:1.2px; color:#f9d976;">
                    ESCANEA DIRECTO DESDE TU APP YAPE O PLIN
                </div>
                <div class="qr-frame">
                    <img id="checkout-qr-img" src="assets/img/qr-yape.jpg" alt="QR Yape Midward Quispe Mamani" onerror="mostrarAvisoFaltaQR(this)">
                </div>
                <div style="font-size:13px;">Monto total a yapear:</div>
                <div class="qr-amount-pill" id="qr-monto-total">S/ 0.00</div>
                <div style="margin-top:10px; font-size:14px; font-weight:800;">
                    Titular Yape: <span style="color:#f9d976;" id="qr-titular-texto">Midward Quispe Mamani</span><br>
                    Celular Yape / WhatsApp: <span id="qr-numero-texto" style="color:#00f5d4;">968 752 081</span>
                </div>
                <div class="qr-actions">
                    <button type="button" class="btn-qr-tool" onclick="copiarNumeroCuenta()">📋 Copiar Celular</button>
                    <button type="button" class="btn-qr-tool" onclick="descargarImagenQR()">⬇️ Descargar QR</button>
                </div>
            </div>

            <!-- Formulario Derecho: Datos del Cliente -->
            <form id="form-confirmar-pago">
                <div class="form-group">
                    <label>Tu Nombre Completo *</label>
                    <input type="text" id="chk-cliente" placeholder="Ej. Midward Quispe" required>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label>Ubicación / Servicio *</label>
                        <select id="chk-mesa">
                            <option value="Mesa 01 - Salón">Mesa 01 - Salón</option>
                            <option value="Mesa 02 - Salón">Mesa 02 - Salón</option>
                            <option value="Mesa 03 - Salón">Mesa 03 - Salón</option>
                            <option value="Mesa 04 - VIP">Mesa 04 - VIP</option>
                            <option value="Para Llevar / Recojo">Para Llevar / Recojo</option>
                            <option value="Delivery a Domicilio">Delivery a Domicilio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Método de Pago *</label>
                        <select id="chk-metodo">
                            <option value="Yape QR (Midward Quispe - 968752081)">📱 Yape QR (968 752 081)</option>
                            <option value="Plin (968752081)">📱 Plin (968 752 081)</option>
                            <option value="Efectivo al Mozo">💵 Efectivo al Mozo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>N° de Operación Yape o Adjuntar Captura *</label>
                    <input type="text" id="chk-operacion" placeholder="Ej. Operación Yape #129485 (o sube tu captura)" required>
                    <label class="file-upload-label" style="margin-top:8px;">
                        📸 Subir Captura del Yapeo (Opcional)
                        <input type="file" id="chk-captura" accept="image/*" style="display:none;" onchange="mostrarNombreCaptura(event)">
                    </label>
                    <small id="captura-nombre" style="color:var(--emerald); margin-top:4px; font-weight:700;"></small>
                </div>

                <button type="submit" class="btn-checkout-qr" style="margin-top:10px;">
                    ✅ Confirmar Mi Pedido Ahora
                </button>
            </form>
        </div>

        <!-- Confirmación de Orden Exitosa -->
        <div id="checkout-success-view" style="display:none; text-align:center; padding:24px 10px;">
            <div style="font-size:54px;">🎉</div>
            <h2 style="font-family:'Playfair Display', serif; color:var(--emerald); margin:8px 0;">¡Pago en Verificación / Pedido Exitoso!</h2>
            <p style="color:var(--text-secondary); max-width:500px; margin:0 auto 16px;">
                Tu orden fue enviada a cocina correctamente. Puedes enviar tu constancia por WhatsApp para atención prioritaria.
            </p>
            <div style="background:var(--bg-card); border:1.5px dashed var(--gold); padding:16px 24px; border-radius:14px; display:inline-block; margin-bottom:20px;">
                <div style="font-size:12px; color:var(--text-secondary);">NÚMERO DE ORDEN</div>
                <div id="orden-generada-codigo" style="font-size:28px; font-weight:800; color:var(--gold-light); letter-spacing:2px;">ORD-00001</div>
            </div>
            <div style="display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
                <button class="btn-add-cart" style="max-width:290px; padding:12px 20px;" onclick="enviarComprobanteWhatsApp()">
                    📲 Enviar Constancia al WhatsApp 968 752 081
                </button>
                <button class="nav-link" onclick="cerrarModalCheckoutQR()">Volver a la Carta</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL CRUD DE PRODUCTO (SOLO MOZO / ADMIN) ================= -->
<div id="modal-producto" class="modal-backdrop">
    <div class="modal-window">
        <div class="modal-header">
            <h3 id="modal-prod-titulo">✨ Agregar Nuevo Producto</h3>
            <button class="close-x" onclick="cerrarModalProducto()">&times;</button>
        </div>

        <div class="crud-split">
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
                    <input type="text" id="prod-nombre" placeholder="Ej. Arroz con Pato Chiclayano" oninput="actualizarVistaPrevia()" required>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label>Precio (S/.) *</label>
                        <input type="number" id="prod-precio" step="0.10" min="0.50" placeholder="32.00" oninput="actualizarVistaPrevia()" required>
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
                    <input type="text" id="prod-descripcion" placeholder="Ingredientes y acompañamiento..." oninput="actualizarVistaPrevia()">
                </div>

                <div class="form-group">
                    <label>Imagen del Producto (Archivo Local o URL)</label>
                    <label class="file-upload-label">
                        📁 Seleccionar Foto desde tu PC
                        <input type="file" id="prod-file" accept="image/*" style="display:none;" onchange="procesarArchivoImagen(event)">
                    </label>
                    <input type="text" id="prod-imagen-url" placeholder="...o pega una URL de imagen (https://...)" style="margin-top:8px;" oninput="actualizarImagenDesdeURL()">
                </div>

                <button type="submit" class="btn-add-cart" style="width:100%; padding:13px; font-size:14.5px;">
                    💾 Guardar Producto en Base de Datos
                </button>
            </form>

            <div>
                <div style="font-size:12px; font-weight:800; text-transform:uppercase; color:var(--gold); margin-bottom:10px;">
                    👁️ Vista Previa en Vivo
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
                            <h4 class="card-title" id="prev-nombre">Nombre del Plato</h4>
                            <p class="card-desc" id="prev-desc">Descripción del plato...</p>
                        </div>
                        <div class="card-footer">
                            <span class="stock-tag" id="prev-stock">🔥 30 disp.</span>
                            <span class="btn-add-cart" style="max-width:120px;">🛒 Pedir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL CONFIGURAR IMAGEN QR YAPE (ADMIN) ================= -->
<div id="modal-config-qr" class="modal-backdrop">
    <div class="modal-window" style="max-width: 480px;">
        <div class="modal-header">
            <h3>⚙️ Configurar QR Oficial de Yape</h3>
            <button class="close-x" onclick="cerrarModalConfigQR()">&times;</button>
        </div>
        <p style="font-size:13px; color:var(--text-secondary); margin-top:0;">
            Sube aquí la imagen de tu QR de Yape (<strong>Midward Quispe Mamani</strong>) para que quede guardada permanentemente y pueda escanearse desde cualquier celular.
        </p>
        <div class="form-group">
            <label>Titular del Yape / Plin</label>
            <input type="text" id="cfg-titular" value="Midward Quispe Mamani">
        </div>
        <div class="form-group">
            <label>Número Yape / WhatsApp</label>
            <input type="text" id="cfg-numero" value="968 752 081">
        </div>
        <div class="form-group">
            <label>Seleccionar tu Imagen QR Oficial de Yape</label>
            <label class="file-upload-label">
                📤 Cargar imagen QR de Yape (WhatsApp Image / JPG / PNG)
                <input type="file" accept="image/*" style="display:none;" onchange="subirNuevoQRAdmin(event)">
            </label>
        </div>
        <button class="btn-add-cart" style="width:100%; padding:12px;" onclick="guardarConfigQR()">💾 Guardar QR Oficial</button>
    </div>
</div>

<div class="toast-container" id="toast-container"></div>

<script>
let catalogo = [];
let categoriaActual = '';
let carrito = JSON.parse(localStorage.getItem('rincon_carrito_v7') || '[]');
let imagenTemporalProducto = '';
let ultimaOrdenDatos = null;
const DEFAULT_FOOD_IMG = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=700&q=80';

/* ==========================================================================
   CONTROL DE ROLES: ZONA CLIENTE VS LOGIN MOZO / ADMINISTRADOR
   ========================================================================== */
function inicializarRol() {
    const sesionStaff = sessionStorage.getItem('rincon_staff_user');
    if (sesionStaff) {
        aplicarEstadoStaff(sesionStaff);
    } else {
        activarVistaCliente();
    }
}

function activarVistaCliente() {
    document.body.setAttribute('data-role', 'cliente');
    document.getElementById('tab-cliente').className = 'role-tab active';
    document.getElementById('tab-staff').className = 'role-tab';
}

function intentarAccesoStaff() {
    const sesionStaff = sessionStorage.getItem('rincon_staff_user');
    if (sesionStaff) {
        aplicarEstadoStaff(sesionStaff);
    } else {
        document.getElementById('login-pass').value = '';
        document.getElementById('modal-login').classList.add('open');
    }
}

function cerrarModalLogin() {
    document.getElementById('modal-login').classList.remove('open');
}

document.getElementById('form-login').addEventListener('submit', function(e) {
    e.preventDefault();
    const user = document.getElementById('login-user').value;
    const pass = document.getElementById('login-pass').value.trim();

    if (pass === '1234' || pass === 'admin') {
        sessionStorage.setItem('rincon_staff_user', user);
        cerrarModalLogin();
        aplicarEstadoStaff(user);
        mostrarToast(`Bienvenido, ${user}`, '🔓');
    } else {
        mostrarToast('Contraseña incorrecta (Usa: 1234)', '❌');
    }
});

function aplicarEstadoStaff(nombreUsuario) {
    document.body.setAttribute('data-role', 'staff');
    document.getElementById('staff-nombre-activo').textContent = nombreUsuario;
    document.getElementById('tab-cliente').className = 'role-tab';
    document.getElementById('tab-staff').className = 'role-tab staff-active';
}

function cerrarSesionStaff() {
    sessionStorage.removeItem('rincon_staff_user');
    activarVistaCliente();
    mostrarToast('Sesión cerrada. Estás en Zona Cliente', '👤');
}

/* ==========================================================================
   NOTIFICACIONES Y TEMA
   ========================================================================== */
function mostrarToast(mensaje, icono = '✨') {
    const cont = document.getElementById('toast-container');
    const div = document.createElement('div');
    div.className = 'toast';
    div.innerHTML = `<span>${icono}</span> <span>${mensaje}</span>`;
    cont.appendChild(div);
    setTimeout(() => div.remove(), 3400);
}

function toggleTheme() {
    const html = document.documentElement;
    const nuevo = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', nuevo);
    localStorage.setItem('rincon_theme', nuevo);
    document.getElementById('btn-theme').textContent = nuevo === 'dark' ? '☀️ Claro' : '🌙 Oscuro';
}
(function() {
    const t = localStorage.getItem('rincon_theme') || 'dark';
    document.documentElement.setAttribute('data-theme', t);
    document.getElementById('btn-theme').textContent = t === 'dark' ? '☀️ Claro' : '🌙 Oscuro';
})();

/* ==========================================================================
   FOTOGRAFÍAS Y CATÁLOGO
   ========================================================================== */
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
        grid.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:40px; color:var(--text-secondary);">No se encontraron especialidades.</div>`;
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
                    <!-- Botones de edición visibles ÚNICAMENTE para Mozo / Administrador -->
                    <div class="card-admin-btns staff-only">
                        <button class="icon-btn" title="Editar producto" onclick="abrirModalProducto(${p.idplato})">✏️</button>
                        <button class="icon-btn del" title="Eliminar producto" onclick="eliminarProducto(${p.idplato}, '${p.nombre.replace(/'/g, "\\'")}')">🗑️</button>
                    </div>
                    <span class="card-price-badge">S/ ${parseFloat(p.precio).toFixed(2)}</span>
                </div>
                <div class="card-body">
                    <div>
                        <span class="card-code">${p.codigo}</span>
                        <h4 class="card-title">${p.nombre}</h4>
                        <p class="card-desc">${p.descripcion || 'Especialidad preparada al momento.'}</p>
                    </div>
                    <div class="card-footer">
                        <span class="stock-tag ${lowStock}">${disponible ? `🔥 ${p.stock} disp.` : '⛔ Agotado'}</span>
                        <button class="btn-add-cart" ${!disponible ? 'disabled' : ''} onclick="agregarAlCarrito(${p.idplato})">
                            🛒 Pedir Plato
                        </button>
                    </div>
                </div>
            </article>
        `;
    });
}

/* ==========================================================================
   CARRITO DE COMPRAS
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
            mostrarToast('Stock máximo disponible alcanzado', '⚠️');
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
    mostrarToast(`${prod.nombre} añadido a tu pedido`, '🛒');
}

function cambiarCantidad(idplato, delta) {
    const idx = carrito.findIndex(i => i.idplato == idplato);
    if (idx === -1) return;
    const nuevo = carrito[idx].cantidad + delta;
    if (nuevo <= 0) carrito.splice(idx, 1);
    else if (nuevo <= carrito[idx].stockMax) carrito[idx].cantidad = nuevo;
    guardarYRenderizarCarrito();
}

function guardarYRenderizarCarrito() {
    localStorage.setItem('rincon_carrito_v7', JSON.stringify(carrito));
    renderizarCarrito();
}

function renderizarCarrito() {
    const cont = document.getElementById('cart-items-container');
    const badge = document.getElementById('cart-badge');
    let total = 0, totalItems = 0;

    if (carrito.length === 0) {
        cont.innerHTML = `<div style="text-align:center; padding:50px 10px; color:var(--text-secondary);">Aún no has seleccionado platos.</div>`;
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
                    <div class="cart-item-price">S/ ${sub.toFixed(2)}</div>
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
   CHECKOUT CON EL QR OFICIAL DE YAPE DE MIDWARD QUISPE MAMANI
   ========================================================================== */
function obtenerImagenQRYapeReal() {
    const qrSubido = localStorage.getItem('rincon_qr_oficial_midward');
    if (qrSubido) return qrSubido;
    return 'assets/img/qr-yape.jpg';
}

function mostrarAvisoFaltaQR(imgEl) {
    // Si aún no copiaron qr-yape.jpg en assets/img, permite cargarlo con un clic
    imgEl.alt = "Sube tu imagen QR de Yape desde el botón Configurar QR";
}

function abrirModalCheckoutQR() {
    if (carrito.length === 0) {
        mostrarToast('Selecciona al menos un plato primero', '⚠️');
        return;
    }
    toggleCart(false);
    const total = carrito.reduce((acc, i) => acc + (i.precio * i.cantidad), 0);
    const numGuardado = localStorage.getItem('rincon_qr_num_v7') || '968 752 081';
    const titularGuardado = localStorage.getItem('rincon_qr_titular_v7') || 'Midward Quispe Mamani';

    document.getElementById('qr-monto-total').textContent = `S/ ${total.toFixed(2)}`;
    document.getElementById('qr-numero-texto').textContent = numGuardado;
    document.getElementById('qr-titular-texto').textContent = titularGuardado;
    document.getElementById('checkout-qr-img').src = obtenerImagenQRYapeReal();

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
    mostrarToast(`Celular Yape ${num} copiado`, '📋');
}

function descargarImagenQR() {
    const link = document.createElement('a');
    link.href = document.getElementById('checkout-qr-img').src;
    link.download = 'QR-Yape-Midward-Quispe.jpg';
    link.click();
    mostrarToast('Descargando QR Oficial de Yape...', '⬇️');
}

function mostrarNombreCaptura(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('captura-nombre').textContent = `✅ Captura lista: ${file.name}`;
        if (!document.getElementById('chk-operacion').value) {
            document.getElementById('chk-operacion').value = `Captura Yape: ${file.name}`;
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
        mostrarToast('¡Pedido registrado con éxito!', '🎉');
    }
});

function enviarComprobanteWhatsApp() {
    if (!ultimaOrdenDatos) return;
    let lista = '';
    ultimaOrdenDatos.items.forEach(i => {
        lista += `• ${i.cantidad}x ${i.nombre} (S/ ${(i.precio * i.cantidad).toFixed(2)})\n`;
    });
    const msg = encodeURIComponent(
        `🍽️ *PEDIDO ${ultimaOrdenDatos.orden} — EL RINCÓN DEL SABOR*\n` +
        `👤 *Cliente:* ${ultimaOrdenDatos.cliente}\n` +
        `📍 *Servicio:* ${ultimaOrdenDatos.mesa}\n` +
        `💳 *Pago:* ${ultimaOrdenDatos.metodo_pago}\n` +
        `🧾 *Comprobante:* ${ultimaOrdenDatos.comprobante}\n\n` +
        `*DETALLE:*\n${lista}\n` +
        `💰 *TOTAL: S/ ${ultimaOrdenDatos.total.toFixed(2)}*`
    );
    window.open(`https://wa.me/51968752081?text=${msg}`, '_blank');
}

/* ==========================================================================
   CRUD DE PRODUCTOS Y CONFIGURACIÓN DEL QR OFICIAL (MOZO / ADMIN)
   ========================================================================== */
function abrirModalProducto(idplato = null) {
    const form = document.getElementById('form-producto');
    form.reset();
    document.getElementById('prod-id').value = '';
    imagenTemporalProducto = '';

    if (idplato) {
        const p = catalogo.find(item => item.idplato == idplato);
        if (!p) return;
        document.getElementById('modal-prod-titulo').textContent = '✏️ Editar Producto';
        document.getElementById('prod-id').value = p.idplato;
        document.getElementById('prod-categoria').value = p.idcategoria;
        document.getElementById('prod-codigo').value = p.codigo;
        document.getElementById('prod-nombre').value = p.nombre;
        document.getElementById('prod-precio').value = p.precio;
        document.getElementById('prod-stock').value = p.stock;
        document.getElementById('prod-condicion').value = p.condicion;
        document.getElementById('prod-descripcion').value = p.descripcion || '';
        imagenTemporalProducto = resolverImagenPlato(p);
    } else {
        document.getElementById('modal-prod-titulo').textContent = '✨ Agregar Nuevo Producto';
        document.getElementById('prod-codigo').value = 'PLT-0' + (catalogo.length + 1);
    }
    actualizarVistaPrevia();
    document.getElementById('modal-producto').classList.add('open');
}
function cerrarModalProducto() { document.getElementById('modal-producto').classList.remove('open'); }

function procesarArchivoImagen(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = evt => {
        imagenTemporalProducto = evt.target.result;
        document.getElementById('prev-img').src = imagenTemporalProducto;
    };
    reader.readAsDataURL(file);
}
function actualizarImagenDesdeURL() {
    const url = document.getElementById('prod-imagen-url').value.trim();
    if (url) { imagenTemporalProducto = url; document.getElementById('prev-img').src = url; }
}
function actualizarVistaPrevia() {
    const selCat = document.getElementById('prod-categoria');
    const catNombre = selCat.options[selCat.selectedIndex].getAttribute('data-nombre');
    const nombre = document.getElementById('prod-nombre').value || 'Nombre del Plato';
    const precio = parseFloat(document.getElementById('prod-precio').value) || 0;
    document.getElementById('prev-cat').textContent = catNombre;
    document.getElementById('prev-codigo').textContent = document.getElementById('prod-codigo').value || 'PLT-000';
    document.getElementById('prev-nombre').textContent = nombre;
    document.getElementById('prev-precio').textContent = `S/ ${precio.toFixed(2)}`;
    document.getElementById('prev-stock').textContent = `🔥 ${document.getElementById('prod-stock').value || 0} disp.`;
    document.getElementById('prev-desc').textContent = document.getElementById('prod-descripcion').value || 'Descripción...';
    document.getElementById('prev-img').src = imagenTemporalProducto || resolverImagenPlato({ nombre, categoria: catNombre });
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
    const res = await fetch(id ? `controllers/carta.php?id=${id}` : 'controllers/carta.php', {
        method: id ? 'PUT' : 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });
    const json = await res.json();
    if (json.status === 'success') {
        cerrarModalProducto();
        mostrarToast('Catálogo actualizado', '✅');
        cargarCatalogo();
    }
});

async function eliminarProducto(id, nombre) {
    if (!confirm(`¿Eliminar "${nombre}" del catálogo?`)) return;
    const res = await fetch(`controllers/carta.php?id=${id}`, { method: 'DELETE' });
    const json = await res.json();
    if (json.status === 'success') {
        mostrarToast('Producto eliminado', '🗑️');
        cargarCatalogo();
    }
}

let qrTempAdmin = '';
function abrirModalConfigQR() {
    document.getElementById('cfg-titular').value = localStorage.getItem('rincon_qr_titular_v7') || 'Midward Quispe Mamani';
    document.getElementById('cfg-numero').value = localStorage.getItem('rincon_qr_num_v7') || '968 752 081';
    document.getElementById('modal-config-qr').classList.add('open');
}
function cerrarModalConfigQR() { document.getElementById('modal-config-qr').classList.remove('open'); }
function subirNuevoQRAdmin(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = evt => { qrTempAdmin = evt.target.result; mostrarToast('QR de Yape cargado y listo para guardar', '📷'); };
    reader.readAsDataURL(file);
}
function guardarConfigQR() {
    localStorage.setItem('rincon_qr_titular_v7', document.getElementById('cfg-titular').value.trim());
    localStorage.setItem('rincon_qr_num_v7', document.getElementById('cfg-numero').value.trim());
    if (qrTempAdmin) localStorage.setItem('rincon_qr_oficial_midward', qrTempAdmin);
    cerrarModalConfigQR();
    mostrarToast('QR Oficial de Midward Quispe guardado', '✅');
}

inicializarRol();
cargarCatalogo();
</script>
</body>
</html>