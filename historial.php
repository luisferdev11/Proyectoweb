<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Servicios</title>
    <link rel="stylesheet" href="historial.css">
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

    <h1 class="title">Historial de Servicios</h1>

    <div class="container">
        <div class="service-box">
            <div class="left-section">
                <h2>ID: 001</h2>
                <p>Fecha: 10/06/2024</p>
                <p>Servicio: Reparación de fugas</p>
                <p>Plomero: Juan Pérez</p>
                <p>Dirección: Calle Principal #123</p>
                <p>Total: $100.00</p>
            </div>
            <div class="right-section">
                <button class="worker-info-btn">Nombre del trabajador asignado</button>
                <button class="progress-btn">Progreso del trabajo</button>
                <button class="factura-btn">Ver Factura</button>
                <button class="cal-btn">Calificar Servicio</button>
            </div>
        </div>
    </div>

    <div id="worker-info-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="worker-details">
                <img src="img/avatar.jpg" alt="Avatar del trabajador">
                <h2>Nombre del Trabajador</h2>
                <p>Teléfono: 123-456-7890</p>
                <p>Cursos: Curso 1, Curso 2, Curso 3</p>
                <p>Bodega: Bodega XYZ</p>
                <div id="map"></div>
                <div class="course-info">
                    <button class="course-btn">Curso 1</button>
                    <button class="course-btn">Curso 2</button>
                    <button class="course-btn">Curso 3</button>
                </div>
            </div>
        </div>
    </div>

    <div id="course-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="course-details">
                <h2>Curso 1</h2>
                <p>Descripción del Curso 1</p>
            </div>
        </div>
    </div>

    <div id="factura-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="factura-details">
                <h2>Factura del Servicio</h2>
                <p>ID del Servicio: 001</p>
                <p>Fecha: 10/06/2024</p>
                <p>Servicio: Reparación de fugas</p>
                <p>Plomero: Juan Pérez</p>
                <p>Dirección: Calle Principal #123</p>
                <p>Total: $100.00</p>
                <p>Impuestos: $15.00</p>
                <p>Total a Pagar: $115.00</p>
            </div>
        </div>
    </div>

    <div id="cal-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="cal-details">
                <h2>Calificar el Servicio</h2>
                <form>
                    <label for="rating">Calificación:</label>
                    <div class="star-rating">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-star" name="rating" value="1" />
                        <label for="1-star" class="star">&#9733;</label>
                    </div>
                    <br>
                    <label for="comments">Comentarios:</label>
                    <textarea id="comments" name="comments" rows="4" cols="50"></textarea>
                    <br>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p></p>
    </footer>

    <script>
        var workerModal = document.getElementById('worker-info-modal');
        var workerBtn = document.getElementsByClassName("worker-info-btn")[0];
        var closeWorkerSpan = document.getElementsByClassName("close")[0];

        workerBtn.onclick = function() {
            workerModal.style.display = "block";
        }

        closeWorkerSpan.onclick = function() {
            workerModal.style.display = "none";
        }

        var courseBtns = document.getElementsByClassName("course-btn");
        var courseModal = document.getElementById('course-modal');

        for (var i = 0; i < courseBtns.length; i++) {
            courseBtns[i].onclick = function() {
                courseModal.style.display = "block";
            }
        }

        var closeCourseSpan = document.getElementsByClassName("close")[1];
        closeCourseSpan.onclick = function() {
            courseModal.style.display = "none";
        }

        var facturaModal = document.getElementById('factura-modal');
        var facturaBtn = document.getElementsByClassName("factura-btn")[0];
        var closeFacturaSpan = document.getElementsByClassName("close")[2];

        facturaBtn.onclick = function() {
            facturaModal.style.display = "block";
        }

        closeFacturaSpan.onclick = function() {
            facturaModal.style.display = "none";
        }

        var calModal = document.getElementById('cal-modal');
        var calBtn = document.getElementsByClassName("cal-btn")[0];
        var closeCalSpan = document.getElementsByClassName("close")[3];

        calBtn.onclick = function() {
            calModal.style.display = "block";
        }

        closeCalSpan.onclick = function() {
            calModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == workerModal) {
                workerModal.style.display = "none";
            }
            if (event.target == courseModal) {
                courseModal.style.display = "none";
            }
            if (event.target == facturaModal) {
                facturaModal.style.display = "none";
            }
            if (event.target == calModal) {
                calModal.style.display = "none";
            }
        }

        function initMap() {
            var bodega = {lat: 40.7128, lng: -74.0060};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: bodega
            });
            var marker = new google.maps.Marker({
                position: bodega,
                map: map
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap"></script>
</body>
</html>
