<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="../css/inicioAdmin.css">
</head>
<body>
    
<?php include '../templates/headerworker.php'; ?>
    
    <h1 class="title">Mi Cuenta</h1>

    <div class="container">
        <a href="servicios.php" class="box">
            <h2>Servicios</h2>
        </a>
        <a href="configuracion.php" class="box">
            <h2>Configuración de la cuenta</h2>
        </a>
        <a href="usosuministros.php" class="box">
            <h2>Uso de suministro</h2>
        </a>
        <a href="disponibilidad.php" class="box">
            <h2>Disponibilidad</h2>
        </a>
        <a href="reportes.php" class="box">
            <h2>Reportes</h2>
        </a>
        <a href="cursos.php" class="box">
            <h2>Mis cursos</h2>
        </a>
    </div>

    <?php include '../templates/footer.php'; ?>

</body>
</html>
