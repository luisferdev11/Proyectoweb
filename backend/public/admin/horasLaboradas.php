<?php
require_once __DIR__ . '/../../includes/session.php';
checkSessionAndRole('administrador');

require_once __DIR__ . '/../../controllers/AdministradorController.php';

$controller = new AdministradorController();
$workers = $controller->getHorasLaboradas($_SESSION['Bodega_id']);

if (isset($_POST['logout'])) {
    $controller->logoutAdministrador();
    header("Location: /public/index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Horas Trabajadas</title>
    <link rel="stylesheet" href="../css/horasLaboradas.css">
</head>
<body>
<?php include '../templates/headeradmin.php'; ?>


    <div class="container">
        <h1>Reporte de Horas Trabajadas</h1>
        <!-- <div class="periodo-container">
            <label for="inicio">Inicio:</label>
            <input type="text" id="inicio" placeholder="dd/mm/aa">
            <label for="fin">Fin:</label>
            <input type="text" id="fin" placeholder="dd/mm/aa">
        </div> -->
        <div class="report-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Especializacion</th>
                        <th>Horas trabajadas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Datos estáticos
                    // $reports = [
                    //     ["id" => 1851, "usuario" => "López García, Juan Antonio", "horas_trabajadas" => 12],
                    //     ["id" => 1454, "usuario" => "Martínez Fernández, Carlos Alberto", "horas_trabajadas" => 1],
                    //     ["id" => 4151, "usuario" => "García Pérez, Andrés Manuel", "horas_trabajadas" => 45],
                    //     ["id" => 2356, "usuario" => "Hernández Ruiz, Maria Fernanda", "horas_trabajadas" => 20],
                    //     ["id" => 4823, "usuario" => "Sánchez Gómez, Ricardo", "horas_trabajadas" => 30]
                    // ];
                    if($workers!==null){
                        // Generar filas de la tabla con datos estáticos
                        foreach ($workers as $worker) {
                            echo "<tr>
                                    <td>{$worker['id']}</td>
                                    <td>{$worker['nombre']}</td>
                                    <td>{$worker['especializacion']}</td>
                                <td>" . round($worker['horas_trabajadas'], 0) . "</td>
                                </tr>";
                        }
                    }else{
                        echo "<tr>
                                    <td>Sin datos suficientes</td>
                                </tr>";
                    }

                    
                    ?>
                </tbody>
            </table>
        </div>
        <!-- <div class="actions">
            <button class="btn btn-secondary">Descargar en PDF</button>
        </div> -->
    </div>
    
    <footer class="footer">
        <p></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>