<?php
require_once __DIR__ . '/../../includes/session.php';
checkSessionAndRole('cliente');

require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_peticion']) && isset($_POST['rating'])) {
    $data = [
        'id_peticion' => $_POST['id_peticion'],
        'calificacion' => $_POST['rating'],
        'observaciones' => $_POST['comentarios']
    ];

    $success = $controller->updatehistorial($data); 
    if ($success) {
    } else {
        echo "Error al enviar la calificación.";
    }
}

$historial = $controller->getHistorialServicios($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Servicios</title>
    <link rel="stylesheet" href="../css/historial.css">
   
</head>
<body>
    <?php include '../templates/headerClient.php'; ?>

    <h1 class="title">Historial de Servicios</h1>
    <div class="container">
        <?php if ($historial !== null && !empty($historial)): ?>
            <?php foreach ($historial as $servicio): ?>
                <div class="service-box">
                    <div class="left-section">
                        <h2>ID: <?php echo htmlspecialchars($servicio['id_peticion']); ?></h2>
                        <p>Fecha: <?php echo htmlspecialchars($servicio['fechapeticion']); ?></p>
                        <p>Servicio: <?php echo htmlspecialchars($servicio['tiposervicio']); ?></p>
                        <p>Descripción: <?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                        <p>Instrucciones Extras: <?php echo htmlspecialchars($servicio['instruccionesextra']); ?></p>
                        <p>Estado: <?php echo htmlspecialchars($servicio['estado']); ?></p>
                        <p>Fecha Programada: <?php echo htmlspecialchars($servicio['fechaprogramada']); ?></p>
                        <p>Hora Programada: <?php echo htmlspecialchars($servicio['horaprogramada']); ?></p>
                    </div>
                    <div class="right-section">
                        <button class="cal-btn" data-id="<?php echo htmlspecialchars($servicio['id_peticion']); ?>">Calificar Servicio</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron servicios en el historial para este usuario.</p>
        <?php endif; ?>
    </div>

    <div id="cal-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="cal-details">
                <h2>Calificar el Servicio</h2>
                <form id="calificarForm" method="POST" action="">
                    <label for="rating">Calificación:</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required>
                    <br>
                    <label for="comentarios">Comentarios:</label>
                    <textarea id="comentarios" name="comentarios" rows="4" cols="50"></textarea>
                    <br>
                    <input type="hidden" id="id_peticion_cal" name="id_peticion" value="">
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div>

   

    <?php include '../templates/footer.php'; ?>

    <script>
        var calModal = document.getElementById('cal-modal');
        var calBtns = document.getElementsByClassName("cal-btn");

        for (var i = 0; i < calBtns.length; i++) {
            calBtns[i].onclick = function() {
                calModal.style.display = "block";
                var idPeticion = this.getAttribute('data-id');
                document.getElementById('id_peticion_cal').value = idPeticion;
            }
        }

        var closeCalSpan = document.getElementsByClassName("close")[0];
        closeCalSpan.onclick = function() {
            calModal.style.display = "none";
        }

        var facModal = document.getElementById('fac-modal');
        var facBtns = document.getElementsByClassName("fac-btn");

        

        var closeFacSpan = document.getElementsByClassName("close")[1];
        closeFacSpan.onclick = function() {
            facModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == calModal) {
                calModal.style.display = "none";
            } else if (event.target == facModal) {
                facModal.style.display = "none";
            }
        }


        var form = document.getElementById('calificarForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/backend/public/client/historial.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    calModal.style.display = "none";
                    alert("Calificación enviada exitosamente.");
                    location.reload(); 
                } else {
                    alert('Error al enviar la calificación.');
                }
            };
            xhr.onerror = function() {
                alert('Error de red.');
            };
            xhr.send(formData);
        });
    </script>

</body>
</html>
