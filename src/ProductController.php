<?php
require_once 'Product.php';

class ProductController {
    private $db;
    private $product;

    public function __construct($db){
        $this->db = $db;
        $this->product = new Product($db);
    }

    public function create(){
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre) && !empty($data->descripcion) && !empty($data->precio)) {
            $this->product->nombre = $data->nombre;
            $this->product->descripcion = $data->descripcion;
            $this->product->precio = $data->precio;

            if ($this->product->create()) {
                http_response_code(201);
                echo json_encode(["message" => "Producto creado con éxito."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "No se pudo crear el producto."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos."]);
        }
    }

    public function read(){
        $stmt = $this->product->read();
        $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $products[] = [
                "id" => $id,
                "nombre" => $nombre,
                "descripcion" => $descripcion,
                "precio" => $precio,
                "creado_en" => $creado_en
            ];
        }

        http_response_code(200);
        echo json_encode($products);
    }
}
?>
