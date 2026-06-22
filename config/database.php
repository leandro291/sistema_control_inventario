<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "inventario";
    public mysqli $conn;

    public function __construct() {
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->name
        );

        if (!$this->conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }
    }
}
?>
