<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de la Cuenta</title>
    <link rel="stylesheet" href="../css/configuracion.css">
</head>
<body>
<?php include '../templates/headerworker.php'; ?>


    <h1 class="title">Configuración de la Cuenta Trabajador</h1>

    <div class="container">
    <form>
            <div class="form-group">
                <label for="Nombre">Nombre:</label>
                <input type="text" id="apellidoP" name="apellidoP" value="Nombre" disabled>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-group">
            <label for="apellidoP">Apellido paterno:</label>
            <input type="text" id="apellidoP" name="apellidoP" value="Apellido Paterno" disable>
                <button type="button" class="edit-btn">Editar</button>
            </div>

            <div class="form-group">
                <label for="apellidoM">Apellido materno:</label>
                <input type="text" id="apellidoM" name="apellidoM" value="Apellido Materno" disable>
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

        <button type="submit">Confirmar cambios</button>
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
