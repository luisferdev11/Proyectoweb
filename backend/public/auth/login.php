<?php

require_once __DIR__ . '/../../controllers/ClienteController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $controller = new ClienteController();
    $result = $controller->loginCliente($correo, $contrasena);

    if ($result) {
        header("Location: /auth/welcome.php");
        exit();
    } else {
        echo "Error al iniciar sesión. Por favor, verifica tus credenciales.";
    }
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
<?php include '../templates/header.php'; ?>

    <div class="container">
        <div class="left-section">
            <img src="../images/logo.jpeg" alt="Imagen de Inicio de Sesión">
        </div>
        <div class="right-section">
            <div class="form-box">
                <h2>Inicio de Sesión</h2>
                <form action="iniciocliente.php" method="POST">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                    
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                    
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>

<?php include '../templates/footer.php'; ?>
</html>
