<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="../css/administraUsuarios.css">
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
    <link rel="stylesheet" href="css/horasLaboradas.css">
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
        <h1>Administrar usuarios trabajadores</h1>
        <div class="busqueda-container">
            <label for="Numero">Buscar por número de empleado:</label>
            <input type="search" id="Numero" placeholder="20201345">
        </div>
        <div class="report-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Datos estáticos
                    $reports = [
                        ["id" => 1851, "usuario" => "López García, Juan Antonio", "rol" => "Plomero"],
                        ["id" => 1454, "usuario" => "Martínez Fernández, Carlos Alberto", "rol" => "Plomero"],
                        ["id" => 4151, "usuario" => "García Pérez, Andrés Manuel", "rol" => "Plomero"],
                        ["id" => 2356, "usuario" => "Hernández Ruiz, Maria Fernanda", "rol" => "Plomero"],
                        ["id" => 4823, "usuario" => "Sánchez Gómez, Ricardo", "rol" => "Plomero"]
                    ];

                    // Generar filas de la tabla con datos estáticos
                    foreach ($reports as $report) {
                        echo "<tr>
                                <td>{$report['id']}</td>
                                <td>{$report['usuario']}</td>
                                <td>{$report['rol']}</td>
                                <td>
                                    <button>Editar</button>
                                    <button>Borrar</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="actions">
            <button class="worker-create">Agregar Trabajador</button>
        </div>
    </div>
    
    <footer class="footer">
        <p></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
