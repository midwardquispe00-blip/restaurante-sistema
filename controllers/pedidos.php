<?php
// C:\xampp\htdocs\restaurante\controllers\pedidos.php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Pedido.php';

$db = (new Database())->getConnection();
$pedido = new Pedido($db);
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {
    echo json_encode(["status" => "success", "data" => $pedido->listarPedidos()], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} elseif ($metodo === 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);
    if (!empty($datos['mesa']) && !empty($datos['cliente']) && !empty($datos['items'])) {
        $id = $pedido->crearPedido($datos['mesa'], $datos['cliente'], $datos['items']);
        echo json_encode([
            "status" => $id ? "success" : "error",
            "idpedido" => $id,
            "message" => $id ? "Pedido #$id registrado correctamente" : "Error en la transacción del pedido"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan datos de mesa, cliente o platos"]);
    }
}