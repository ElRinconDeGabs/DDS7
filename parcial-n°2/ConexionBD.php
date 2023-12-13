<?php
class ConexionBD
{
    private $conn;

    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "labsdb";

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    public function obtenerConexion()
    {
        return $this->conn;
    }

    public function cerrarConexion()
    {
        $this->conn = null;
    }
}
?>
