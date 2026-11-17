<?php
// C:\xampp\htdocs\restaurante\models\Pedido.php

class Pedido {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar pedido completo con transacción segura (cabecera, detalle y descuento de stock)
    public function crearPedido($mesa, $cliente, $items) {
        try {
            $this->conn->beginTransaction();

            $total = 0;
            foreach ($items as $item) {
                $total += $item['cantidad'] * $item['precio'];
            }

            // 1. Insertar cabecera del pedido
            $sqlPedido = "INSERT INTO pedido (mesa, cliente, total, estado) 
                          VALUES (:mesa, :cliente, :total, 'Atendido')";
            $stmt = $this->conn->prepare($sqlPedido);
            $stmt->execute([
                ':mesa'    => $mesa,
                ':cliente' => $cliente,
                ':total'   => $total
            ]);
            $idpedido = $this->conn->lastInsertId();

            // 2. Insertar cada plato en detalle_pedido y actualizar stock
            $sqlDetalle = "INSERT INTO detalle_pedido (idpedido, idplato, cantidad, precio_venta) 
                           VALUES (:idpedido, :idplato, :cantidad, :precio)";
            $stmtDet = $this->conn->prepare($sqlDetalle);

            $sqlStock = "UPDATE plato SET stock = stock - :cantidad WHERE idplato = :idplato";
            $stmtStock = $this->conn->prepare($sqlStock);

            foreach ($items as $item) {
                $stmtDet->execute([
                    ':idpedido' => $idpedido,
                    ':idplato'  => $item['idplato'],
                    ':cantidad' => $item['cantidad'],
                    ':precio'   => $item['precio']
                ]);

                $stmtStock->execute([
                    ':cantidad' => $item['cantidad'],
                    ':idplato'  => $item['idplato']
                ]);
            }

            $this->conn->commit();
            return $idpedido;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // Listar historial de pedidos realizados
    public function listarPedidos() {
        $query = "SELECT p.idpedido, p.mesa, p.cliente, p.total, p.estado, p.fecha,
                         COUNT(d.iddetalle) AS cantidad_items
                  FROM pedido p
                  LEFT JOIN detalle_pedido d ON p.idpedido = d.idpedido
                  GROUP BY p.idpedido
                  ORDER BY p.idpedido DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}