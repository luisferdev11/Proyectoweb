<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos de los Trabajadores</title>
    <link rel="stylesheet" href="css/cursosTrabajadores.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.jpeg" alt="Logo de la Empresa">
        </div>
        <ul class="nav-links">
            <li><a href="historial.php">Historial de compras</a></li>
            <li><a href="configuracion.php">Configuración de la cuenta</a></li>
            <li><a href="solicitud.php">Solicitar servicio</a></li>
            <li><a href="pagos.php">Mis pagos</a></li>
            <li><a href="evaluacion.php">Evaluación de servicios</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h1>Cursos de los trabajadores</h1>
        <?php
        // Datos estáticos
        $employees = [
            [
                "numero_empleado" => "12345",
                "nombre" => "Juan Pérez",
                "correo" => "juan.perez@example.com",
                "telefono" => "123-456-7890",
                "cursos" => [
                    ["nombre" => "Detección y Reparación de Fugas de Agua", "inicio" => "12/08/2024"],
                    ["nombre" => "Detección y Reparación de Fugas de Agua", "inicio" => "12/08/2024"]
                ]
            ],
            [
                "numero_empleado" => "12346",
                "nombre" => "María Fernández",
                "correo" => "maria.fernandez@example.com",
                "telefono" => "123-456-7891",
                "cursos" => []
            ]
        ];

        // Generar tarjetas de cursos
        foreach ($employees as $employee) {
            echo "<div class='employee-card'>
                    <p><strong>Número de empleado:</strong> {$employee['numero_empleado']}</p>
                    <p><strong>Nombre:</strong> {$employee['nombre']}</p>
                    <p><strong>Correo:</strong> {$employee['correo']}</p>
                    <p><strong>Teléfono:</strong> {$employee['telefono']}</p>
                    <div class='cursos-container'>";
            if (!empty($employee['cursos'])) {
                foreach ($employee['cursos'] as $curso) {
                    echo "<div class='curso-card'>
                            <p>{$curso['nombre']}</p>
                            <p><strong>Inicio:</strong> {$curso['inicio']}</p>
                            <button class='btn btn-danger'>X</button>
                          </div>";
                }
            } else {
                echo "<p>No hay elementos por mostrar</p>";
            }
            echo "  </div>
                    <button class='btn btn-primary' onclick='openModal()'>Agregar Curso</button>
                  </div>";
        }
        ?>
    </div>

    <!-- Modal para agregar curso -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Agregar Curso o Certificación</h2>
            <form>
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ex: Microsoft certified network associate security" required><br>
                <label for="organizacion">Organización emisora*</label>
                <input type="text" id="organizacion" name="organizacion" placeholder="Ex: Microsoft" required><br>
                <label for="fecha_emision">Fecha de emisión</label><br>
                <select id="mes_emision" name="mes_emision">
                    <option value="">Mes</option>
                    <!-- Add months here -->
                </select>
                <select id="ano_emision" name="ano_emision">
                    <option value="">Año</option>
                    <!-- Add years here -->
                </select><br>
                <label for="fecha_expiracion">Fecha de expiración</label><br>
                <select id="mes_expiracion" name="mes_expiracion">
                    <option value="">Mes</option>
                    <!-- Add months here -->
                </select>
                <select id="ano_expiracion" name="ano_expiracion">
                    <option value="">Año</option>
                    <!-- Add years here -->
                </select><br>
                <label for="id_credencial">ID de la credencial</label>
                <input type="text" id="id_credencial" name="id_credencial"><br>
                <label for="url_credencial">URL de la credencial</label>
                <input type="text" id="url_credencial" name="url_credencial"><br>
                <button type="button" class="btn btn-success" onclick="closeModal()">Agregar</button>
                <button type="button" class="btn btn-danger" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>


    <footer class="footer">
        <p></p>
    </footer>

    <script>
        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }


    </script>
</body>
</html>
