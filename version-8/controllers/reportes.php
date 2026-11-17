<?php
// C:\xampp\htdocs\restaurante\controllers\reportes.php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/database.php';

$db = (new Database())->getConnection();

// 1. Resumen general de ventas y pedidos
$stmtResumen = $db->query("
    SELECT 
        COUNT(*) AS total_pedidos,
        COALESCE(SUM(total), 0) AS ingresos_totales,
        COALESCE(AVG(total), 0) AS ticket_promedio
    FROM pedido
");
$resumen = $stmtResumen->fetch();

// 2. Ranking de platos más vendidos
$stmtTop = $db->query("
    SELECT 
        pl.codigo,
        pl.nombre,
        c.nombre AS categoria,
        SUM(d.cantidad) AS total_vendido,
        SUM(d.cantidad * d.precio_venta) AS recaudado
    FROM detalle_pedido d
    INNER JOIN plato pl ON d.idplato = pl.idplato
    INNER JOIN categoria c ON pl.idcategoria = c.idcategoria
    GROUP BY pl.idplato
    ORDER BY total_vendido DESC
    LIMIT 10
");
$topPlatos = $stmtTop->fetchAll();

// 3. Platos con stock crítico (menor o igual a 10 unidades)
$stmtStock = $db->query("
    SELECT codigo, nombre, stock 
    FROM plato 
    WHERE stock <= 10 AND condicion = 1
    ORDER BY stock ASC
");
$stockBajo = $stmtStock->fetchAll();

echo json_encode([
    "status" => "success",
    "resumen" => $resumen,
    "top_platos" => $topPlatos,
    "stock_bajo" => $stockBajo
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
