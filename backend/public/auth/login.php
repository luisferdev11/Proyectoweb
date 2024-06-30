<?php

require_once __DIR__ . '/../../controllers/ClienteController.php';
require_once __DIR__ . '/../../controllers/EmpleadoController.php';
require_once __DIR__ . '/../../controllers/AdministradorController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $role = $_POST['role']; // Se agrega para diferenciar el tipo de usuario

    if ($role == 'cliente') {
        $controller = new ClienteController();
        $result = $controller->loginCliente($correo, $contrasena);
        if ($result) {
            header("Location: /public/client/home.php");
            exit();
        }
    } elseif ($role == 'empleado') {
        $controller = new EmpleadoController();
        $result = $controller->loginEmpleado($correo, $contrasena);
        if ($result) {
            header("Location: /public/worker/home.php");
            exit();
        }
    } elseif ($role == 'administrador') {
        $controller = new AdministradorController();
        $result = $controller->loginAdministrador($correo, $contrasena);
        if ($result) {
            header("Location: /public/admin/home.php");
            exit();
        }
    }

    echo "Error al iniciar sesión. Por favor, verifica tus credenciales.";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/InicioS.css">
</head>
<body>
<?php include '../templates/header.php'; ?>

    <div class="container">
        <div class="left-section">
            <img src="../images/logo.jpeg" alt="Imagen de Inicio de Sesión">
        </div>
        <div class="right-section">
            <div class="form-box">
                <h2>Inicio de Sesión</h2>
                <form action="login.php" method="POST">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                    
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>

                    <label for="role">Rol:</label>
                    <select id="role" name="role">
                        <option value="cliente">Cliente</option>
                        <option value="empleado">Empleado</option>
                        <option value="administrador">Administrador</option>
                    </select>
                    
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>

<?php include '../templates/footer.php'; ?>
</body>
</html>
