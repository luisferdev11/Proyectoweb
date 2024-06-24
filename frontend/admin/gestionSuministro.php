<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Suministros</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="../css/gestionSuministro.css">
    </head>
<body>
<nav class="navbar">
        <div class="logo">
        <img src="../images/logo.jpeg" alt="Logo de la Empresa">
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Inicio</a></li>
            <li><a href="gestionSuministro.php">Gestión de suministros</a></li>
            <li><a href="administraUsuarios.php">Administrar Usuarios</a></li>
            <li><a href="configuracion.php">Configuración</a></li>
            <li><a href="costos.php">Costos</a></li>
            <li><a href="asignaciones.php">Asignaciones</a></li>
            <li><a href="horasLaboradas.php">Horas Laboradas</a></li>
           
=======
    <link rel="stylesheet" href="css/gestionSuministro.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.jpeg" alt="Logo de la Empresa">
        </div>
        <ul class="nav-links">
            <li><a href="historial.php">Historial de compras</a></li>
            <li><a href="configuracion.php">Configuración de la cuenta</a></li>
            <li><a href="solicitud.php">Solicitar servicio</a></li>
            <li><a href="pagos.php">Mis pagos</a></li>
            <li><a href="evaluacion.php">Evaluación de servicios</a></li>
>>>>>>> e6c8a39ced55ab12ef8fa898d291a1373ea9f235
        </ul>
    </nav>

    <div class="container">
        <h1>Actualización de suministros</h1>
        <div class="supplies-container">
            <table>
                <thead>
                    <tr>
                        <th>ID del suministro</th>
                        <th>Nombre del suministro</th>
                        <th>Cantidad</th>
                        <th>Unidad de medida</th>
                        <th>Cantidad mínima</th>
                        <th>Cantidad máxima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
<<<<<<< HEAD
=======
                    // Datos estáticos
>>>>>>> e6c8a39ced55ab12ef8fa898d291a1373ea9f235
                    $supplies = [
                        ["id" => 151, "nombre" => "Tubo", "cantidad" => "10", "unidad" => "m", "minima" => "5", "maxima" => "50"],
                        ["id" => 565, "nombre" => "Manguera", "cantidad" => "8", "unidad" => "m", "minima" => "3", "maxima" => "30"],
                        ["id" => 789, "nombre" => "Cinta", "cantidad" => "1", "unidad" => "pieza", "minima" => "1", "maxima" => "10"],
                        ["id" => 345, "nombre" => "Llave inglesa", "cantidad" => "15", "unidad" => "pieza", "minima" => "5", "maxima" => "20"],
                        ["id" => 456, "nombre" => "Destornillador", "cantidad" => "12", "unidad" => "pieza", "minima" => "6", "maxima" => "25"],
                        ["id" => 678, "nombre" => "Martillo", "cantidad" => "7", "unidad" => "pieza", "minima" => "2", "maxima" => "15"],
                        ["id" => 234, "nombre" => "Pinzas", "cantidad" => "5", "unidad" => "pieza", "minima" => "2", "maxima" => "10"],
                        ["id" => 890, "nombre" => "Serrucho", "cantidad" => "3", "unidad" => "pieza", "minima" => "1", "maxima" => "5"],
                        ["id" => 912, "nombre" => "Taladro", "cantidad" => "4", "unidad" => "pieza", "minima" => "1", "maxima" => "6"]
                    ];

<<<<<<< HEAD
=======
                    // Generar filas de la tabla con datos estáticos
>>>>>>> e6c8a39ced55ab12ef8fa898d291a1373ea9f235
                    foreach ($supplies as $supply) {
                        echo "<tr>
                                <td>{$supply['id']}</td>
                                <td><input type='text' value='{$supply['nombre']}' readonly></td>
                                <td><input type='text' value='{$supply['cantidad']}'></td>
                                <td><input type='text' value='{$supply['unidad']}'></td>
                                <td><input type='text' value='{$supply['minima']}'></td>
                                <td><input type='text' value='{$supply['maxima']}'></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="actions">
            <button class="btn btn-primary">Suministrar el almacén</button>
            <button class="btn btn-secondary">Descargar en PDF</button>
        </div>
    </div>



    

    <footer class="footer">
        <p></p>
    </footer>
</body>

</html>
