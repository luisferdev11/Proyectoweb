<?php
require_once __DIR__ . '/../../includes/session.php';
checkSessionAndRole('cliente');

require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();
$profile = $controller->getProfile($_SESSION['user_id']);

if (isset($_POST['logout'])) {
    $controller->logoutCliente();
    header("Location: /public/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id_persona' => $_SESSION['user_id'],
        'Nombre' => $_POST['name'],
        'ApellidoMaterno' => $_POST['apellido_materno'],
        'ApellidoPaterno' => $_POST['apellido_paterno'],
        'FechaNacimiento' => $_POST['fecha_nacimiento'],
        'Correo' => $_POST['email'],
        'Telefono' => $_POST['phone']
    ];

    $result = $controller->updateProfile($data);

    if ($result) {
        echo "Perfil actualizado exitosamente.";
        // Actualizar el perfil obtenido
        $profile = $controller->getProfile($_SESSION['user_id']);

        
    } else {
        echo "Error al actualizar el perfil.";
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de la Cuenta</title>
    <link rel="stylesheet" href="../css/configuracion.css">
</head>
<body>
<?php include '../templates/headerClient.php'; ?>

    <h1 class="title">Configuración de la Cuenta</h1>

    <div class="container">
        <form class="config-form" action="" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($profile['nombre']); ?>">
                <!-- <button type="button" class="edit-btn">Editar</button> -->
            </div>

            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo htmlspecialchars($profile['apellidopaterno']); ?>">
                <!-- <button type="button" class="edit-btn">Editar</button> -->
            </div>

            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo htmlspecialchars($profile['apellidomaterno']); ?>">
                <!-- <button type="button" class="edit-btn">Editar</button> -->
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($profile['fechanacimiento']); ?>">
                <!-- <button type="button" class="edit-btn">Editar</button> -->
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($profile['correo']); ?>">
                <!-- <button type="button" class="edit-btn">Editar</button> -->
            </div>

            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($profile['telefono']); ?>">
                <!-- <button type="button" class="edit-btn">Editar</button> -->
            </div>

            <div class="form-buttons">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>

        <!-- Cerrar sesion -->
        <form action="" method="POST">
            <input type="hidden" name="logout" value="true">
            <div class="form-buttons">
                <button type="submit" class="form-buttons" style="background-color: rebeccapurple;">Cerrar Sesión</button>
            </div>
        </form>
    </div>



    <?php include '../templates/footer.php'; ?>
    
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                let inputField = this.previousElementSibling;
                if (inputField.disabled) {
                    inputField.disabled = false;
                    inputField.focus();
                    this.textContent = 'Guardar';
                } else {
                    inputField.disabled = true;
                    this.textContent = 'Editar';
                }
            });
        });
    </script>
</body>
</html>
