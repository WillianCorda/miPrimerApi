<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $creado_en;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table_name . " SET nombre = :nombre, descripcion = :descripcion, precio = :precio, creado_en = NOW()";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY creado_en DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
