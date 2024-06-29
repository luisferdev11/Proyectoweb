<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/EmpleadoController.php';

checkSessionAndRole('empleado');

$controller = new EmpleadoController();
$servicios = $controller->getServiciosAsignados($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Asignados</title>
    <link rel="stylesheet" href="../css/servicios.css">
    <link rel="stylesheet" href="../css/InicioS.css" />
</head>
<body>
<?php include '../templates/headerWorker.php'; ?>

<h1 class="title">Servicios Asignados</h1>

<div class="container">
    <?php if (empty($servicios)): ?>
        <p>No tienes servicios asignados en este momento.</p>
    <?php else: ?>
        <?php foreach ($servicios as $servicio): ?>
            <div class="service-box">
                <h2>Servicio: <?php echo htmlspecialchars($servicio['TipoServicio']); ?></h2>
                <p>Descripción: <?php echo htmlspecialchars($servicio['Descripcion']); ?></p>
                <p>Instrucciones Extra: <?php echo htmlspecialchars($servicio['InstruccionesExtra']); ?></p>
                <p>Fecha Programada: <?php echo htmlspecialchars($servicio['FechaProgramada']); ?></p>
                <p>Hora Programada: <?php echo htmlspecialchars($servicio['HoraProgramada']); ?></p>
                <p>Estado: <?php echo htmlspecialchars($servicio['Estado']); ?></p>
                <p>Hora Inicio: <?php echo htmlspecialchars($servicio['Horainicio']); ?></p>
                <p>Hora Fin: <?php echo htmlspecialchars($servicio['Horafin']); ?></p>
                <p>Calificación: <?php echo htmlspecialchars($servicio['Calificacion']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include '../templates/footer.php'; ?>
</body>
</html>
