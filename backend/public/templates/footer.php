<!-- poner footer con display normal, quitar el fixed -->
<style>
    .footer {
        background-color: #1E90FF; 
        color: white;
        text-align: center;
        padding: 30px 0;
        width: 100%;
        bottom: 0;
        position: fixed; /* Por defecto en fixed */
    }

    .footer.relative {
        position: relative;
    }
</style>

<footer class="footer">
    <p>&copy; 2024 PlomerosSOS. Todos los derechos reservados.</p>
    <p>
        <a href="/src/views/privacidad.php">Política de Privacidad</a> | 
        <a href="/src/views/terminos.php">Términos y Condiciones</a>
    </p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function adjustFooter() {
            var footer = document.querySelector('.footer');
            var bodyHeight = document.body.scrollHeight;
            var windowHeight = window.innerHeight;

            if (bodyHeight > windowHeight) {
                footer.classList.add('relative');
            } else {
                footer.classList.remove('relative');
            }
        }

        adjustFooter();
        window.addEventListener('resize', adjustFooter);
    });
</script>
