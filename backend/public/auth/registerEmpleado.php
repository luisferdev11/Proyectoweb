<?php
require_once __DIR__ . '/../../controllers/EmpleadoController.php';
require_once __DIR__ . '/../../controllers/BodegaController.php';

$bodegaController = new BodegaController();
$bodegas = $bodegaController->getBodegas();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'nombre' => $_POST['nombre'],
        'apellido_materno' => $_POST['apellido_materno'],
        'apellido_paterno' => $_POST['apellido_paterno'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'],
        'contrasena' => $_POST['contrasena'],
        'id_bodega' => $_POST['id_bodega'],
        'numero_empleado' => $_POST['numero_empleado'],
        'especializacion' => $_POST['especializacion']
    ];

    $controller = new EmpleadoController();
    $result = $controller->registerEmpleado($data);

    if ($result) {
        echo "Empleado registrado exitosamente.";
        header("Location: loginEmpleado.php");
        exit();
    } else {
        echo "Error al registrar el empleado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleado</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
<?php include '../templates/header.php'; ?>

    <div class="container">
        <div class="left-section">
            <img src="../images/logo.jpeg" alt="Imagen de Registro">
            <!-- Opcion para ir a inicio de sesion si ya tiene cuenta, ponerlo abajo de la imagen -->
        </div>
        <div class="right-section">
            <div class="form-box">
                <h2 class="title">Registro de Empleado</h2>
                <a href="/public/auth/loginEmpleado.php">Ya tienes una cuenta?, inicia sesión</a>
                <br>
                <br>
                <form action="registerEmpleado.php" method="POST">
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

                    <label for="id_bodega">Bodega:</label>
                    <select id="id_bodega" name="id_bodega" required>
                        <?php foreach ($bodegas as $bodega): ?>
                            <option value="<?php echo htmlspecialchars($bodega['id_bodega']); ?>"><?php echo htmlspecialchars($bodega['ubicacion']); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="numero_empleado">Número de Empleado:</label>
                    <input type="text" id="numero_empleado" name="numero_empleado" required>

                    <label for="especializacion">Especialización:</label>
                    <input type="text" id="especializacion" name="especializacion" required>

                    <button type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <?php // include '../templates/footer.php'; ?>
</body>
</html>
