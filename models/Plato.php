<?php
// C:\xampp\htdocs\restaurante\models\Plato.php

class Plato {
    private $conn;
    private $table_name = "plato";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT p.idplato, p.codigo, p.nombre, p.precio, p.stock, p.descripcion, 
                         p.imagen, p.condicion, c.idcategoria, c.nombre AS categoria
                  FROM " . $this->table_name . " p
                  INNER JOIN categoria c ON p.idcategoria = c.idcategoria
                  ORDER BY p.idplato DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idplato = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function registrar($idcategoria, $codigo, $nombre, $precio, $stock, $descripcion, $imagen = null) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (idcategoria, codigo, nombre, precio, stock, descripcion, imagen, condicion)
                  VALUES (:idcategoria, :codigo, :nombre, :precio, :stock, :descripcion, :imagen, 1)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idcategoria", $idcategoria, PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":imagen", $imagen);

        return $stmt->execute();
    }

    public function actualizar($idplato, $idcategoria, $codigo, $nombre, $precio, $stock, $descripcion, $imagen, $condicion) {
        $query = "UPDATE " . $this->table_name . "
                  SET idcategoria = :idcategoria,
                      codigo = :codigo,
                      nombre = :nombre,
                      precio = :precio,
                      stock = :stock,
                      descripcion = :descripcion,
                      imagen = :imagen,
                      condicion = :condicion
                  WHERE idplato = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $idplato, PDO::PARAM_INT);
        $stmt->bindParam(":idcategoria", $idcategoria, PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":imagen", $imagen);
        $stmt->bindParam(":condicion", $condicion, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function eliminar($idplato) {
        // Desasociar en detalle_pedido si existe o eliminar registro directamente
        try {
            $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE idplato = :id");
            $stmt->bindParam(":id", $idplato, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Si tiene ventas históricas, pasa a inactivo para mantener integridad referencial
            $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET condicion = 0 WHERE idplato = :id");
            $stmt->bindParam(":id", $idplato, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
}