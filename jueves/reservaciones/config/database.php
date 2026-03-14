<?php
// reservaciones/config/database.php

class Database
{
    private $host = "db";
    private $db_name = "appdb";
    private $username = "appuser";
    private $password = "apppass";
    public $conn;

    // Conexión MySQLi
    public function connect()
    {
        $this->conn = null;
        
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die("Error conexión MySQLi: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Conexión PDO
    public function connectPDO()
    {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", 
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error conexión PDO: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>