<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/ServicioController.php';

checkSessionAndRole('empleado');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_servicio = $_POST['id_servicio'];
    $observaciones = $_POST['observaciones'];

    $controller = new ServicioController();
    $result = $controller->actualizarServicio($id_servicio, $observaciones);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
