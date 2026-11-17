<?php
// C:\xampp\htdocs\restaurante\controllers\pedidos.php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Pedido.php';

$db = (new Database())->getConnection();
$pedido = new Pedido($db);
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {
    echo json_encode(["status" => "success", "data" => $pedido->listarPedidos()], JSON_UNESCAPED_UNICODE);
} elseif ($metodo === 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);
    if (!empty($datos['mesa']) && !empty($datos['cliente']) && !empty($datos['items'])) {
        $metodo_pago = !empty($datos['metodo_pago']) ? $datos['metodo_pago'] : 'Yape / Plin QR';
        $comprobante = !empty($datos['comprobante']) ? $datos['comprobante'] : 'Validado en línea';
        $id = $pedido->crearPedido($datos['mesa'], $datos['cliente'], $metodo_pago, $comprobante, $datos['items']);
        echo json_encode([
            "status" => $id ? "success" : "error",
            "idpedido" => $id,
            "orden_codigo" => "ORD-" . str_pad($id, 5, "0", STR_PAD_LEFT),
            "message" => $id ? "¡Pago en verificación / Pedido exitoso!" : "Error al procesar la orden"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan datos del pedido"]);
    }
}