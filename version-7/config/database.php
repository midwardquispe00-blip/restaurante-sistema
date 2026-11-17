<?php
// C:\xampp\htdocs\restaurante\config\database.php

class Database {
    private $host = "localhost";
    private $db_name = "dbrestaurante";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conn = new PDO($dsn, $this->username, $this->password, $opciones);
        } catch (PDOException $e) {
            die(json_encode([
                "status" => "error",
                "message" => "Error de conexión a dbrestaurante: " . $e->getMessage()
            ]));
        }
        return $this->conn;
    }
}