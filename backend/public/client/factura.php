<?php
require_once __DIR__ . '/../../includes/session.php';
checkSessionAndRole('cliente');

require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();



$historial = $controller->getFactura($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Servicios</title>
    <link rel="stylesheet" href="../css/historial.css">
   
</head>
<body>
    <?php include '../templates/headerClient.php'; ?>

    <h1 class="title">Factura de Servicios</h1>
    <div class="container">
    <?php if ($historial !== null && !empty($historial)): ?>
        <?php foreach ($historial as $servicio): ?>
            <div class="service-box">
                <div class="left-section">
                    <h2>ID: <?php echo htmlspecialchars($servicio['id_servicio']); ?></h2>
                    <p>Nombre del empleado: <?php echo htmlspecialchars($servicio['nombre_empleado']); ?></p>
                    <p>Servicio: <?php echo htmlspecialchars($servicio['tiposervicio']); ?></p>
                    <p>Descripción: <?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                    <p>Estado: <?php echo htmlspecialchars($servicio['estado']); ?></p>
                    <p>Hora inicio: <?php echo htmlspecialchars($servicio['horainicio']); ?></p>
                    <p>Costo: <?php echo htmlspecialchars($servicio['costo']); ?></p>
                    <p>Precio: <?php echo htmlspecialchars($servicio['precio']); ?></p>
                    <p>Calificación: <?php echo htmlspecialchars($servicio['calificacion']); ?></p>
                    <p>Observaciones: <?php echo htmlspecialchars($servicio['observaciones']); ?></p>              
                </div>
              
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron facturas para este usuario.</p>
    <?php endif; ?>
</div>


   

   

    <?php include '../templates/footer.php'; ?>



</body>
</html>
