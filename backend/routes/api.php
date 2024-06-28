<?php

require_once '../controllers/ClienteController.php';

header("Content-Type: application/json; charset=UTF-8");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[2] !== 'cliente') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new ClienteController();

switch ($requestMethod) {
    case 'POST':
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $result = $controller->registerCliente($input);
        $response = $result ? ['message' => 'Cliente registrado exitosamente.'] : ['message' => 'Error al registrar el cliente.'];
        echo json_encode($response);
        break;
    case 'GET':
        $id = (int) $_GET['id'];
        $cliente = $controller->getClienteById($id);
        echo json_encode($cliente);
        break;
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
}

?>
