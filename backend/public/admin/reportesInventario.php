<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes e Inventario</title>
    <link rel="stylesheet" href="../css/reportesInventario.css">
</head>
<body>
<?php include '../templates/headeradmin.php'; ?>


    <h1 class="title">Reportes e Inventario</h1>

    <div class="main-container">
        <div class="left-section">
            <div class="report-card">
                <h2 class="status">Aprobado</h2>
                <p><strong>Cliente:</strong> Juan Pérez</p>
                <p><strong>Dirección:</strong> Calle Principal #123</p>
                <p><strong>Servicio:</strong> Reparación de fugas</p>
                <p><strong>Fecha y Hora:</strong> 10/06/2024 14:00</p>
                <p><strong>ID del Servicio:</strong> 001</p>
                <h3>Suministros Utilizados</h3>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Unidad de Medida</th>
                    </tr>
                    <tr>
                        <td>Tubería</td>
                        <td>101</td>
                        <td>3</td>
                        <td>Metros</td>
                    </tr>
                    <tr>
                        <td>Sellador</td>
                        <td>102</td>
                        <td>1</td>
                        <td>Litros</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="right-section">
            <h2>Inventario de Suministros</h2>
            <table class="inventory-table">
                <tr>
                    <th>Nombre</th>
                    <th>ID</th>
                    <th>Cantidad</th>
                    <th>Unidad de Medida</th>
                </tr>
                <tr>
                    <td>Tubería</td>
                    <td>101</td>
                    <td>50</td>
                    <td>Metros</td>
                </tr>
                <tr>
                    <td>Sellador</td>
                    <td>102</td>
                    <td>20</td>
                    <td>Litros</td>
                </tr>
              
            </table>
        </div>
    </div>
    <?php include '../templates/footer.php'; ?>

</body>
</html>
