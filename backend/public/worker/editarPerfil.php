<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/EmpleadoController.php';

checkSessionAndRole('empleado');

$controller = new EmpleadoController();
$profile = $controller->getProfile($_SESSION['user_id']);


if (isset($_POST['logout'])) {
    $controller->logoutEmpeleado();
    header("Location: /public/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id_persona' => $_SESSION['user_id'],
        'Nombre' => $_POST['Nombre'],
        'ApellidoMaterno' => $_POST['ApellidoMaterno'],
        'ApellidoPaterno' => $_POST['ApellidoPaterno'],
        'Correo' => $_POST['Correo'],
        'Telefono' => $_POST['Telefono']
    ];

    $result = $controller->updateProfile($data);

    if ($result) {
        echo "Perfil actualizado exitosamente.";
        // Recargar los datos del perfil
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
<?php include '../templates/headerWorker.php'; ?>

<h1 class="title">Configuración de la Cuenta Trabajador</h1>

<div class="container">
    <form action="editarPerfil.php" method="POST">
        <div class="form-group">
            <label for="Nombre">Nombre:</label>
            <input type="text" id="Nombre" name="Nombre" value="<?php echo htmlspecialchars($profile['nombre']); ?>">
            <!-- <button type="button" class="edit-btn">Editar</button> -->
        </div>

        <div class="form-group">
            <label for="ApellidoPaterno">Apellido Paterno:</label>
            <input type="text" id="ApellidoPaterno" name="ApellidoPaterno" value="<?php echo htmlspecialchars($profile['apellidopaterno']); ?>">
            <!-- <button type="button" class="edit-btn">Editar</button> -->
        </div>

        <div class="form-group">
            <label for="ApellidoMaterno">Apellido Materno:</label>
            <input type="text" id="ApellidoMaterno" name="ApellidoMaterno" value="<?php echo htmlspecialchars($profile['apellidomaterno']); ?>">
            <!-- <button type="button" class="edit-btn">Editar</button> -->
        </div>

        <div class="form-group">
            <label for="Correo">Correo Electrónico:</label>
            <input type="email" id="Correo" name="Correo" value="<?php echo htmlspecialchars($profile['correo']); ?>">
            <!-- <button type="button" class="edit-btn">Editar</button> -->
        </div>

        <div class="form-group">
            <label for="Telefono">Teléfono:</label>
            <input type="tel" id="Telefono" name="Telefono" value="<?php echo htmlspecialchars($profile['telefono']); ?>">
            <!-- <button type="button" class="edit-btn">Editar</button> -->
        </div>
        <br>

        <button type="submit" class="edit-btn">Confirmar cambios</button>
    </form>
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
