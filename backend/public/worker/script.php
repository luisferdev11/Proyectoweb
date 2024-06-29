<?php

require_once __DIR__ . '/../../controllers/ServicioController.php';

$controller = new ServicioController();
$result = $controller->asignarEmpleadoExistente();

if ($result) {
    echo "Empleados asignados correctamente a los servicios existentes.";
} else {
    echo "Error al asignar empleados a los servicios existentes.";
}
?>