<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Costos de Servicio</title>
    <link rel="stylesheet" href="css/costos.css">
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
        </ul>
    </nav>

    <div class="container">
        <h1>Reporte de Costos de Servicio</h1>
        <div class="periodo-container">
            <label for="periodo">Periodo:</label>
            <button class="btn-periodo" onclick="setPeriodo('semanal')">semanal</button>
            <button class="btn-periodo" onclick="setPeriodo('mensual')">mensual</button>
            <button class="btn-periodo" onclick="setPeriodo('trimestral')">trimestral</button>
        </div>
        <div class="report-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre del cliente</th>
                        <th>Fecha</th>
                        <th>Tipo de servicio</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Datos estáticos
                    $reports = [
                        ["cliente" => "Carlos López", "fecha" => "2023-06-01", "servicio" => "Reparación de tubería", "costo" => 150],
                        ["cliente" => "Ana Gómez", "fecha" => "2023-06-02", "servicio" => "Instalación de calentador", "costo" => 200],
                        ["cliente" => "Pedro Martínez", "fecha" => "2023-06-03", "servicio" => "Mantenimiento de tinaco", "costo" => 100],
                        ["cliente" => "Luis Ramírez", "fecha" => "2023-06-04", "servicio" => "Cambio de grifo", "costo" => 50],
                        ["cliente" => "Marta Fernández", "fecha" => "2023-06-05", "servicio" => "Desatasco de tubería", "costo" => 120]
                    ];

                    // Generar filas de la tabla con datos estáticos
                    foreach ($reports as $report) {
                        echo "<tr>
                                <td>{$report['cliente']}</td>
                                <td>{$report['fecha']}</td>
                                <td>{$report['servicio']}</td>
                                <td>\${$report['costo']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="actions">
            <p>Total de costo en el periodo: $<?php echo array_sum(array_column($reports, 'costo')); ?></p>
            <button class="btn btn-secondary">descargar en PDF</button>
        </div>
    </div>

    <footer class="footer">
        <p></p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
