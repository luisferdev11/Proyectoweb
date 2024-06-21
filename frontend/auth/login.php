<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/InicioS.css">
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
            <img src="img/logo.jpeg" alt="Imagen de Inicio de Sesión">
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

    <footer class="footer">
        <p></p>
    </footer>
</body>
</html>
