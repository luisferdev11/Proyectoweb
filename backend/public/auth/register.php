<?php

require_once __DIR__ . '/../../controllers/ClienteController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'nombre' => $_POST['nombre'],
        'apellido_materno' => $_POST['apellido_materno'],
        'apellido_paterno' => $_POST['apellido_paterno'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'],
        'contrasena' => $_POST['contrasena']
    ];

    $controller = new ClienteController();
    $result = $controller->registerCliente($data);

    if ($result) {
        header("Location: /public/client/home.php");
        exit();
    } else {
        echo "Error al registrar el cliente.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
    <?php include '../templates/header.php'; ?>

    <div class="container">
        <div class="left-section">
            <img src="../images/logo.jpeg" alt="Imagen de Registro">
        </div>
        <div class="right-section">
            <div class="form-box">
                <h2>Registro</h2>
                <form action="register.php" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                    
                    <label for="apellido_paterno">Apellido Paterno:</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" required>
                    
                    <label for="apellido_materno">Apellido Materno:</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" required>
                    
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                    
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                    
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                    
                    <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
                    
                    <button type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>

<?php include '../templates/footer.php'; ?>
</html>
