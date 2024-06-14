<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes e Inventario</title>
    <link rel="stylesheet" href="reporteseinventario.css">
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
            <!-- Más tarjetas de reportes pueden ir aquí -->
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
                <!-- Más filas de inventario pueden ir aquí -->
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>© 2024 Empresa de Servicios. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
