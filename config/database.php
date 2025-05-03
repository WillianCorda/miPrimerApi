<?php
class DataBase {

    private $host = "localhost"; // localhost es el servidor local donde se encuentra la base de datos
    private $db_name = "stock";
    private $username ="root"; // usuario por defecto de mysql
    private $password = ""; // contraseña por defecto de mysql
    private $conn; // variable para la conexion a la base de datos
    
    // funcion para iniciar la conexion
    public function getConnection() {
        $this->conn = null;

        // try catch para ejecutar y si hay un error poder atraparlo
        try {
            $this->conn = new PDO("mysql:host".$this->host . "dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set name utf8");
        } catch (\Throwable $th) {
            echo "Error en la conexion: " . $th->getMessage();
            
        }
        return $this->conn;





}}