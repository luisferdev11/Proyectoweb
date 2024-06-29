<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/ServicioController.php';

checkSessionAndRole('empleado');

$controller = new ServicioController();
$servicios = $controller->getServiciosAsignados($_SESSION['worker_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_servicio = $_POST['id_servicio'];
    $resultado = $controller->completarServicio($id_servicio);

    if ($resultado) {
        echo "<script>alert('Servicio marcado como completado.'); window.location.href='servicios.php';</script>";
    } else {
        echo "<script>alert('Error al marcar el servicio como completado.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Asignados</title>
    <link rel="stylesheet" href="../css/InicioS.css">
    <link rel="stylesheet" href="../css/servicios.css">
</head>
<body>
<?php include '../templates/headerWorker.php'; ?>

<h1 class="title">Servicios Asignados</h1>

<div class="container">
    <div class="service-container">
        <?php if (empty($servicios)): ?>
            <p class="message">No tienes servicios asignados en este momento.</p>
        <?php else: ?>
            <?php foreach ($servicios as $servicio): ?>
                <div class="service-box">
                    <h2>Servicio: <?php echo htmlspecialchars($servicio['tiposervicio']); ?></h2>
                    <p>Descripción: <?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                    <p>Instrucciones Extra: <?php echo htmlspecialchars($servicio['instruccionesextra']); ?></p>
                    <p>Fecha Programada: <?php echo htmlspecialchars($servicio['fechaprogramada']); ?></p>
                    <p>Hora Programada: <?php echo htmlspecialchars($servicio['horaprogramada']); ?></p>
                    <p>Estado: <?php echo htmlspecialchars($servicio['estado']); ?></p>
                    <p>Hora Inicio: <?php echo htmlspecialchars($servicio['horainicio']); ?></p>
                    <p>Hora Fin: <?php echo htmlspecialchars($servicio['horafin']); ?></p>
                    <p>Calificación: <?php echo htmlspecialchars($servicio['calificacion']); ?></p>
                    <?php if ($servicio['estado'] !== 'Completado'): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="id_servicio" value="<?php echo $servicio['id_servicio']; ?>">
                            <button type="submit" class="btn">Marcar como Completado</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
</body>
</html>
