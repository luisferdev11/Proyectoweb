<?php
require_once __DIR__ . '/../../includes/session.php';
checkSessionAndRole('cliente');

require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id_persona' => $_SESSION['user_id'],
        'id_cliente' => $_SESSION['client_id'],
        'TipoServicio' => $_POST['service-type'],
        'Descripcion' => $_POST['description'],
        'InstruccionesExtra' => $_POST['additional-info'],
        'FechaProgramada' => $_POST['date'],
        'HoraProgramada' => $_POST['time'],
        'FechaPeticion' => date('Y-m-d'),
        'Estado' => 'Pendiente',
        'Direccion' => $_POST['address'],
        'NumeroTarjeta' => $_POST['card-number'],
        'NombreTitular' => $_POST['card-name'],
        'FechaExpiracion' => $_POST['expiry-date'],
        'CVV' => $_POST['cvv']
    ];

    // echo var_dump($data);

    $result = $controller->makeSolicitud($data);

    if ($result) {
        // Redirigir o mostrar mensaje de éxito
        header("Location: /public/client/home.php");
    } else {
        echo "Error al realizar la solicitud de servicio.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Servicio</title>
    <link rel="stylesheet" href="../css/solicitud.css">
</head>
<body>
<?php include '../templates/headerClient.php'; ?>

    <h1 class="title">Solicitud de Servicio</h1>

    <div class="container">
        <form class="service-form" action="" method="POST">
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
            <span class="expiration">
                <input type="text" id="expiry-month" name="expiry-month" placeholder="MM" maxlength="2" size="2" required />
                <span>/</span>
                <input type="text" id="expiry-year" name="expiry-year" placeholder="YY" maxlength="2" size="2" required />
            </span>
            <input type="hidden" id="expiry-date" name="expiry-date" />


            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <div class="form-buttons">
                <button type="button" onclick="window.location.href='index.php'">Regresar</button>
                <button type="submit">Pagar</button>
            </div>
        </form>
    </div>


    <?php include '../templates/footer.php'; ?>

    <script>
        document.querySelector('.service-form').addEventListener('submit', function(event) {
            var month = document.getElementById('expiry-month').value;
            var year = document.getElementById('expiry-year').value;
            document.getElementById('expiry-date').value = month + '/' + year;
        });
    </script>


</body>
</html>
    