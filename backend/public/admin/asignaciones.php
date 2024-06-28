<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones</title>
    <link rel="stylesheet" href="../css/asignaciones.css">
</head>
<body>
<?php include '../templates/headeradmin.php'; ?>


    <h1 class="title">Asignaciones</h1>

    <div class="container">
        <div class="assignment-box">
            <h2>Cliente: Juan Pérez</h2>
            <p>Dirección: Calle Principal #123</p>
            <p>Servicio: Reparación de fugas</p>
            <p>Descripción del problema: Fuga de agua en el baño</p>
            <p>Fecha y Hora: 10/06/2024 14:00</p>
            <p>Instrucciones extra: Llamar antes de llegar</p>
            <div class="buttons">
                <button type="button">Aceptar</button>
                <button type="button">Rechazar</button>
            </div>
        </div>

        <div class="assignment-box">
            <h2>Cliente: María López</h2>
            <p>Dirección: Calle Secundaria #456</p>
            <p>Servicio: Instalación de calentador</p>
            <p>Descripción del problema: Necesita instalar un calentador nuevo</p>
            <p>Fecha y Hora: 12/06/2024 10:00</p>
            <p>Instrucciones extra: Llevar herramientas propias</p>
            <div class="buttons">
                <button type="button">Aceptar</button>
                <button type="button">Rechazar</button>
            </div>
        </div>
    </div>

    <?php include '../templates/footer.php'; ?>

</body>
</html>