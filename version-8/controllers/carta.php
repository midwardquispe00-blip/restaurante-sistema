<?php
// C:\xampp\htdocs\restaurante\controllers\carta.php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Plato.php';

$db = (new Database())->getConnection();
$plato = new Plato($db);
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        if (isset($_GET['id'])) {
            $item = $plato->obtenerPorId($_GET['id']);
            echo json_encode(["status" => $item ? "success" : "error", "data" => $item], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "success", "data" => $plato->listar()], JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        $datos = json_decode(file_get_contents("php://input"), true);
        if (!empty($datos['codigo']) && !empty($datos['nombre']) && isset($datos['precio'])) {
            $stock = isset($datos['stock']) ? (int)$datos['stock'] : 25;
            $desc  = isset($datos['descripcion']) ? $datos['descripcion'] : '';
            $img   = !empty($datos['imagen']) ? $datos['imagen'] : null;
            $ok = $plato->registrar($datos['idcategoria'], $datos['codigo'], $datos['nombre'], $datos['precio'], $stock, $desc, $img);
            echo json_encode(["status" => $ok ? "success" : "error", "message" => $ok ? "Producto guardado en MySQL" : "Error al registrar"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Completa todos los campos obligatorios"]);
        }
        break;

    case 'PUT':
        $datos = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['id'])) {
            $img = !empty($datos['imagen']) ? $datos['imagen'] : null;
            $ok = $plato->actualizar(
                $_GET['id'],
                $datos['idcategoria'],
                $datos['codigo'],
                $datos['nombre'],
                $datos['precio'],
                $datos['stock'],
                $datos['descripcion'],
                $img,
                $datos['condicion']
            );
            echo json_encode(["status" => $ok ? "success" : "error", "message" => $ok ? "Producto actualizado" : "Error al actualizar"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $ok = $plato->eliminar($_GET['id']);
            echo json_encode(["status" => $ok ? "success" : "error", "message" => $ok ? "Producto eliminado del catálogo" : "No se pudo eliminar"]);
        }
        break;
}