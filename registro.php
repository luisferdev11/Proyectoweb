<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.jpeg" alt="Logo de la Empresa">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="registro.php">Registro</a></li>
            <li><a href="InicioS.php">Sesión</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="left-section">
            <img src="img/logo.jpeg" alt="Imagen de Registro">
        </div>
        <div class="right-section">
            <div class="form-box">
                <h2>Registro</h2>
                <form action="registro.php" method="POST">
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
                    
                    <label for="direccion1">Línea de Dirección 1:</label>
                    <input type="text" id="direccion1" name="direccion1" required>
                    
                    <label for="direccion2">Línea de Dirección 2:</label>
                    <input type="text" id="direccion2" name="direccion2">
                    
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

    <footer class="footer">
        <p>© 2024 Plomeros SOS. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
