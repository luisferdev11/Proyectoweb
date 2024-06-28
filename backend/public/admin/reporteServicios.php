<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Servicio</title>
    <link rel="stylesheet" href="../css/reporteServiciosAdmin.css">
</head>
<body>
<?php include '../templates/headeradmin.php'; ?>


    <div class="container">
        <h1>Reportes de servicio</h1>
        <?php
        // Datos estáticos
        $reports = [
            [
                "numero_empleado" => "12345",
                "nombre_trabajador" => "Juan Pérez",
                "cliente" => "Carlos López",
                "direccion" => "Calle Falsa 123",
                "servicio" => "Reparación de tubería",
                "fecha_hora" => "2023-06-14 10:00",
                "id_servicio" => "001",
                "estado" => "Pendiente",
                "suministros" => [
                    ["nombre" => "Tubo", "id" => "151", "cantidad" => "2", "unidad" => "m"]
                ]
            ],
            [
                "numero_empleado" => "12346",
                "nombre_trabajador" => "María Fernández",
                "cliente" => "Ana Gómez",
                "direccion" => "Avenida Siempreviva 742",
                "servicio" => "Instalación de calentador",
                "fecha_hora" => "2023-06-15 14:00",
                "id_servicio" => "002",
                "estado" => "Aprobado",
                "suministros" => [
                    ["nombre" => "Codo", "id" => "152", "cantidad" => "1", "unidad" => "pieza"]
                ]
            ]
        ];

        // Generar tarjetas de reportes
        foreach ($reports as $report) {
            echo "<div class='report-card'>
                    <p><strong>Número de empleado:</strong> {$report['numero_empleado']}</p>
                    <p><strong>Nombre del trabajador:</strong> {$report['nombre_trabajador']}</p>
                    <p><strong>Cliente:</strong> {$report['cliente']}</p>
                    <p><strong>Dirección:</strong> {$report['direccion']}</p>
                    <p><strong>Servicio:</strong> {$report['servicio']}</p>
                    <p><strong>Fecha y hora del servicio:</strong> {$report['fecha_hora']}</p>
                    <p><strong>ID del servicio:</strong> {$report['id_servicio']}</p>
                    <div class='suministros-utilizados'>
                        <p><strong>Suministros utilizados</strong></p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre del suministro</th>
                                    <th>ID del suministro</th>
                                    <th>Cantidad utilizada</th>
                                    <th>Unidad de medida</th>
                                </tr>
                            </thead>
                            <tbody>";
            foreach ($report['suministros'] as $suministro) {
                echo "<tr>
                        <td>{$suministro['nombre']}</td>
                        <td>{$suministro['id']}</td>
                        <td><input type='text' value='{$suministro['cantidad']}' readonly></td>
                        <td><input type='text' value='{$suministro['unidad']}' readonly></td>
                      </tr>";
            }
            echo "      </tbody>
                        </table>
                    </div>
                    <div class='estado'>
                        <span class='estado-{$report['estado']}'>{$report['estado']}</span>
                    </div>
                    <button class='btn btn-success'>Aprobar</button>
                </div>";
        }
        ?>
    </div>

    <?php include '../templates/footer.php'; ?>


    <script src="script.js"></script>
</body>
</html>
