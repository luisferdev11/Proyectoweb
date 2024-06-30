<?php
require_once __DIR__ . '/../../includes/session.php';
checkSessionAndRole('administrador');


require_once __DIR__ . '/../../controllers/AdministradorController.php';

$controller = new AdministradorController();


if (isset($_POST['logout'])) {
    $controller->logoutAdministrador();
    header("Location: /public/index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio administrador</title>
    <link rel="stylesheet" href="../css/inicioAdmin.css">
</head>
<body>
<?php include '../templates/headeradmin.php'; ?>
    

    <h1 class="title">Bienvenido <?php echo $_SESSION['user_name']; ?> administrador de bodega <?php echo $_SESSION['Bodega_id']; ?> </h1>


    <div class="container">
        <a href="gestionSuministro.php" class="box">
            <h2>Gestionar suministros</h2>
        </a>
        <a href="costos.php" class="box">
            <h2>Reporte de costos</h2>
        </a>
        <a href="administraUsuarios.php" class="box">
            <h2>Trabajadores activos</h2>
        </a>
        <a href="horasLaboradas.php" class="box">
            <h2>Reportes por hora</h2>
        </a>
        <a href="reporteServicios.php" class="box">
            <h2>Reportes de servicio</h2>
        </a>
        
    </div>

    <?php include '../templates/footer.php'; ?>

</body>
</html>