<?php
require_once '../config/database.php';
require_once '../src/ProductController.php';

$database = new Database();
$db = $database->getConnection();

$productController = new ProductController($db);

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET':
        $productController->read();
        break;

    case 'POST':
        $productController->create();
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido"]);
        break;
}
?>
