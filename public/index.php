<?php

// index ejecuta todas las peticiones que se realicen(en este caso utilizando postman)

require_once "../src/ProductController.php";

// los siguientes son para evitar problemas de cors (Cross-Origin Resource Sharing) que es un mecanismo de seguridad que permite o restringe el acceso a recursos en un servidor desde diferentes dominios
header("Acces-control-allow-origin: *"); // permite el acceso a cualquier origen * es un comodin
header("Content-Type: application/json; charset=UTF-8") ; // se define el tipo de contenido que se va a enviar y el charset

// se utiliza para almacenar peticiones HTTP como (GET,POST, PUT Y DELETE)
// se utiliza para almacenar la url que se va a utilizar en la peticion
$method = $_SERVER["REQUEST_METHOD"];

// se instancia la clase ProductController+
$productController = new ProductController();

// ulitilizando Switrch se evalua el metodo de la peticion

switch($method)
{
    case 'POST':
        //creamos un producto utilizamos el metodo create que esta dentro de la clase controles la cual esta instanciada en $productController
        $productController->create();
        break;
    case 'GET':
        //leemos un productos utilizamos el metodo create que esta dentro de la clase controles la cual esta instanciada en $productController
        $productController->read();
        break;
    case 'PUT': // put es para actualizar un producto
        //Actualizar un producto utilizamos el metodo create que esta dentro de la clase controles la cual esta instanciada en $productController
        $productController->update();
        break;
    case 'DELETE':// DELETE es para borrar un producto
        //Borrar un producto utilizamos el metodo create que esta dentro de la clase controles la cual esta instanciada en $productController
        $productController->delete();
        break;
    default:
        // http_response_code es una funcion que viene predefinida para poder responder consultas http
        http_response_code(405); // el 405 es un codigo de error de metodo no permitido en la api
        //las api res casi siempre se responden en formato json
        echo json_encode(["message"=>"Metodo no permitido"]);// se envia por json con un array asociativo que tiene el mensaje metodo no permitido

        break;
    
}