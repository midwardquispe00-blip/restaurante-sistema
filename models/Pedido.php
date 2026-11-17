<?php
// C:\xampp\htdocs\restaurante\models\Pedido.php

class Pedido {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearPedido($mesa, $cliente, $metodo_pago, $items) {
        try {
            $this->conn->beginTransaction();

            $total = 0;
            foreach ($items as $item) {
                $total += $item['cantidad'] * $item['precio'];
            }

            $sqlPedido = "INSERT INTO pedido (mesa, cliente, metodo_pago, total, estado) 
                          VALUES (:mesa, :cliente, :metodo_pago, :total, 'Atendido')";
            $stmt = $this->conn->prepare($sqlPedido);
            $stmt->execute([
                ':mesa'        => $mesa,
                ':cliente'     => $cliente,
                ':metodo_pago' => $metodo_pago,
                ':total'       => $total
            ]);
            $idpedido = $this->conn->lastInsertId();

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

    public function listarPedidos() {
        $query = "SELECT p.idpedido, p.mesa, p.cliente, p.metodo_pago, p.total, p.estado, p.fecha,
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