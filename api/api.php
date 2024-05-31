<?php
include ('../models/ProductoDAO.php');
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
$method = $_SERVER['REQUEST_METHOD'];
$productoDAO = new ProductoDAO();

switch ($method) {
    case 'OPTIONS':
        // Respond to preflight request
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        http_response_code(204);
        exit;

    case 'GET':
        $producto = $productoDAO->traerProducto();
        print_r(json_encode($producto));
        break;
    case 'POST':
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if (!isset($data['id']) || !isset($data['nombre']) || !isset($data['descripcion'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Datos incompletos']);
                break;
            }
            $producto = $productoDAO->agregarProducto($data['id'], $data['nombre'], $data['descripcion']);
            echo json_encode($producto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al agregar producto']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $producto = $productoDAO->actualizarProducto($data['id'], $data['nombre'], $data['descripcion']);
        echo(json_encode($producto)); 
        break;
    case 'DELETE':
        // Extract ID from the URL
        $url_parts = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url_parts);
        if (is_numeric($id)) {
            $producto = $productoDAO->eliminarProducto($id);
            echo json_encode($producto);
        } else {
            http_response_code(400);
            echo json_encode(array("mensaje" => "ID no proporcionado o no es numérico"));
        }
        break;
    default:
    http_response_code(405);
    echo json_encode(array("mensaje" => "Metodo no soportado"));
    break;
 
        
}
?>