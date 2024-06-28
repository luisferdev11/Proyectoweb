<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Servicio</title>
    <link rel="stylesheet" href="css/solicitud.css">
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

    <h1 class="title">Solicitud de Servicio</h1>

    <div class="container">
        <form class="service-form">
            <label for="service-type">Tipo de Servicio:</label>
            <select id="service-type" name="service-type">
                <option value="reparacion-fugas">Reparación de Fugas</option>
                <option value="instalacion-plomeria">Instalación de Plomería</option>
                <option value="mantenimiento-general">Mantenimiento General</option>
            </select>

            <label for="description">Descripción del Problema:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="date">Fecha:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Horario:</label>
            <input type="time" id="time" name="time" required>

            <label for="additional-info">Indicaciones Adicionales:</label>
            <textarea id="additional-info" name="additional-info" rows="4"></textarea>

            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" required>

            <h2>Detalles de la Tarjeta</h2>

            <label for="card-name">Nombre en la Tarjeta:</label>
            <input type="text" id="card-name" name="card-name" required>

            <label for="card-number">Número de Tarjeta:</label>
            <input type="text" id="card-number" name="card-number" required>

            <label for="expiry-date">Fecha de Expiración:</label>
            <input type="month" id="expiry-date" name="expiry-date" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <div class="form-buttons">
                <button type="button" onclick="window.location.href='index.php'">Regresar</button>
                <button type="submit">Pagar</button>
            </div>
        </form>
    </div>

    <footer class="footer">
        <p></p>
    </footer>
</body>
</html>
    