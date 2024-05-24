<?php
include ('../models/ProductoDAO.php');
header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$productoDAO = new ProductoDAO();

switch ($method) {
    case 'GET':
        $producto = $productoDAO->traerProducto();
        print_r(json_encode($producto));
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $producto = $productoDAO->agregarProducto($data['id'], $data['nombre'], $data['descripcion'],);
        echo(json_encode($producto)); 
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $producto = $productoDAO->actualizarProducto($data['id'], $data['nombre'], $data['descripcion']);
        echo(json_encode($producto)); 
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $producto = $productoDAO->eliminarProducto($data['id']);
        echo(json_encode($producto)); 
        break;
    default:
    http_response_code(405);
    echo json_encode(array("mensaje" => "Metodo no soportado"));
    break;
 
        
}
?>