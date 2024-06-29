<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/DisponibilidadController.php';

checkSessionAndRole('empleado');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'id_empleado' => $_SESSION['worker_id'],
        'Fecha' => $_POST['fecha'],
        'HoraInicio' => $_POST['hora_inicio'],
        'HoraFin' => $_POST['hora_fin']
    ];

    $controller = new DisponibilidadController();
    $result = $controller->addDisponibilidad($data);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
