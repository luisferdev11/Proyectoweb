<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Horas Trabajadas</title>
    <link rel="stylesheet" href="../css/horasLaboradas.css">
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
           
        </ul>
    </nav>
    <div class="container">
        <h1>Reporte de Horas Trabajadas</h1>
        <div class="periodo-container">
            <label for="inicio">Inicio:</label>
            <input type="text" id="inicio" placeholder="dd/mm/aa">
            <label for="fin">Fin:</label>
            <input type="text" id="fin" placeholder="dd/mm/aa">
        </div>
        <div class="report-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Horas trabajadas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Datos estáticos
                    $reports = [
                        ["id" => 1851, "usuario" => "López García, Juan Antonio", "horas_trabajadas" => 12],
                        ["id" => 1454, "usuario" => "Martínez Fernández, Carlos Alberto", "horas_trabajadas" => 1],
                        ["id" => 4151, "usuario" => "García Pérez, Andrés Manuel", "horas_trabajadas" => 45],
                        ["id" => 2356, "usuario" => "Hernández Ruiz, Maria Fernanda", "horas_trabajadas" => 20],
                        ["id" => 4823, "usuario" => "Sánchez Gómez, Ricardo", "horas_trabajadas" => 30]
                    ];

                    // Generar filas de la tabla con datos estáticos
                    foreach ($reports as $report) {
                        echo "<tr>
                                <td>{$report['id']}</td>
                                <td>{$report['usuario']}</td>
                                <td>{$report['horas_trabajadas']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="actions">
            <button class="btn btn-secondary">Descargar en PDF</button>
        </div>
    </div>
    
    <footer class="footer">
        <p></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
