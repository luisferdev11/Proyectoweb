<?php
    // si tiene sesion iniciado redirigir al home
    session_start();
    if ($_SESSION['user_role'] == "cliente") {
        header("Location: /public/client/home.php");
        exit();
    }
    if ($_SESSION['user_role'] == "empleado") {
        header("Location: /public/worker/home.php");
        exit();
    }
    if ($_SESSION['user_role'] == "administrador") {
        header("Location: /public/admin/home.php");
        exit();
    }
?>

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PlomerosSOS</title>
        <link rel="stylesheet" href="css/index.css">
        
</head>

<?php include 'templates/header.php'; ?>

    <div class="content">
        <h1 class="text-center">Plomeros SOS</h1>
        <p>En Plomeros SOS, nos especializamos en soluciones rápidas y confiables para todas sus necesidades de plomería. Con años de experiencia, nuestro equipo de profesionales garantiza un servicio de alta calidad en cada trabajo.

Servicios que ofrecemos:

Reparación de fugas
Instalación de sistemas de plomería
Mantenimiento preventivo
Desatascos de tuberías
Inspección y reparación de calentadores de agua
¿Por qué elegirnos?

Respuesta rápida: Atención inmediata y disponibilidad 24/7.
Profesionalismo: Técnicos certificados que aseguran un trabajo limpio y eficiente.
Precios justos: Presupuestos transparentes sin cargos ocultos.
Confíe en Plomeros SOS para resolver cualquier problema de plomería con la calidad que usted se merece. ¡Contáctenos hoy!   </p>
        
        <div class="grid-container">
            <div class="grid-item">
                <img src="images/mantenimientotinacos.jpeg" alt="Imagen 1">
                <p>Mantenimiento de tinacos</p>
            </div>
            <div class="grid-item">
                <img src="images/consulta.jpeg" alt="Imagen 2">
                <p>Consulta</p>
            </div>
            <div class="grid-item">
                <img src="images/plomeria.jpeg" alt="Imagen 3">
                <p>Servicio de urgencia</p>
            </div>
            <div class="grid-item">
                <img src="images/instalacion.jpeg" alt="Imagen 4">
                <p>Instalacion de tinacos</p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="gray-section">
            <div class="content">
                <div class="left-side">
                    <h2>Referencia</h2>
                    <p>"Recientemente, tuve el placer de utilizar los servicios de Plomeros SOS y quedé sumamente impresionado. Desde el primer contacto, su atención al cliente fue excepcional, programando una cita rápidamente y a mi conveniencia. El técnico llegó puntual, identificado y equipado, y demostró un nivel de profesionalismo admirable.

Mi problema de fuga de agua fue solucionado de manera eficiente y limpia. El plomero explicó claramente el problema y la solución, utilizando materiales de alta calidad y sin dejar desorden alguno. Además, los precios fueron muy competitivos, con un presupuesto claro y sin sorpresas.

Recomiendo altamente a Plomeros SOS por su rapidez, profesionalismo y precios justos. Sin duda, acudiré a ellos nuevamente para cualquier necesidad de plomería. ¡Un servicio de cinco estrellas!"</p>
                </div>
                <div class="right-side">
                    <img src="images/plomero.jpeg" alt="Imagen grande">
                </div>
            </div>
        </div>

    </div>

<?php include 'templates/footer.php'; ?>
    <script src="/public/js/scripts.js"></script>
</body>
</html>