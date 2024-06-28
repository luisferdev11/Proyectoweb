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
    

    <h1 class="title">Bienvenido administrador de bodega # </h1>

    <div class="container">
        <a href="asignaciones.php" class="box">
            <h2>Asignaciones</h2>
        </a>
        <a href="configuracion.php" class="box">
            <h2>Configuración de la cuenta</h2>
        </a>
        <a href="administrarusuarios.php" class="box">
            <h2>Trabajadores activos</h2>
        </a>
        <a href="horaslaboradas.php" class="box">
            <h2>Reportes por hora</h2>
        </a>
        <a href="reportesserviciosadmin.php" class="box">
            <h2>Reportes de servicio</h2>
        </a>
        <a href="cursostrabajadores.php" class="box">
            <h2>Cursos de trabajadores</h2>
        </a>
    </div>

    <?php include '../templates/footer.php'; ?>

</body>
</html>