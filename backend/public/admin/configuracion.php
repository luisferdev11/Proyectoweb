<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de la Cuenta</title>
<<<<<<< HEAD:frontend/admin/configuracion.php
    <link rel="stylesheet" href="../css/configuracion.css">
=======
    <link rel="stylesheet" href="css/configuracion.css">
>>>>>>> e6c8a39ced55ab12ef8fa898d291a1373ea9f235:configuracion.php
</head>
<body>
<nav class="navbar">
        <div class="logo">
        <img src="../images/logo.jpeg" alt="Logo de la Empresa">
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Inicio</a></li>
            <li><a href="gestionSuministro.php">Gestión de suministros</a></li>
            <li><a href="administraUsuarios.php">Administrar Usuarios</a></li>
            <li><a href="configuracion.php">Configuración</a></li>
            <li><a href="costos.php">Costos</a></li>
            <li><a href="asignaciones.php">Asignaciones</a></li>
            <li><a href="horasLaboradas.php">Horas Laboradas</a></li>
           
        </ul>
    </nav>

    <h1 class="title">Configuración de la Cuenta</h1>

    <div class="container">
        <form class="config-form">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="Nombre del Usuario" disabled>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="usuario@correo.com" disabled>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone" value="123-456-7890" disabled>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" value="Calle Principal #123" disabled>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" value="password" disabled>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-buttons">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <footer class="footer">
        <p></p>
    </footer>

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
