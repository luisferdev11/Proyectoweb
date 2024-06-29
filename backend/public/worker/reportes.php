<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/ServicioController.php';

checkSessionAndRole('empleado');

$controller = new ServicioController();
$servicios = $controller->getServiciosPendientes($_SESSION['worker_id']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="../css/reportes.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
<?php include '../templates/headerWorker.php'; ?>

<div class="container">
    <h1>Reportes pendientes</h1>
    <div class="report-container">
        <?php foreach ($servicios as $servicio): ?>
        <div class="report-card">
            <p><strong>ID:</strong> <?php echo htmlspecialchars($servicio['id_servicio']); ?></p>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($servicio['fechaprogramada']); ?></p>
            <p><strong>Servicio:</strong> <?php echo htmlspecialchars($servicio['tiposervicio']); ?></p>
            <p><strong>Cliente:</strong> <?php echo htmlspecialchars($servicio['clientenombre']); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($servicio['direccion']); ?></p>
            <p><strong>Total:</strong> <?php echo htmlspecialchars($servicio['precio']); ?></p>
            <p><strong>Observaciones:</strong></p>
            <textarea id="observaciones-<?php echo $servicio['id_servicio']; ?>" rows="4"></textarea>
            <button class="btn btn-primary" onclick="generarReporte(<?php echo $servicio['id_servicio']; ?>)">Generar Reporte</button>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>

<script>
    function generarReporte(id_servicio) {
        var observaciones = document.getElementById('observaciones-' + id_servicio).value;
        
        $.ajax({
            url: 'generarReporte.php',
            method: 'POST',
            data: {
                id_servicio: id_servicio,
                observaciones: observaciones
            },
            success: function(response) {
                if (response === 'success') {
                    alert('Reporte generado correctamente.');
                    location.reload();
                } else {
                    alert('Error al generar el reporte.');
                }
            },
            error: function() {
                alert('Error al generar el reporte.');
            }
        });
    }
</script>
</body>
</html>
