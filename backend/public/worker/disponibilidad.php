<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/DisponibilidadController.php';

checkSessionAndRole('empleado');

echo var_dump($_SESSION);

$controller = new DisponibilidadController();
$disponibilidad = $controller->getDisponibilidad($_SESSION['worker_id']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilidad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="../css/disponibilidad.css">
</head>
<body>
<?php include '../templates/headerWorker.php'; ?>

<h1 class="title">Disponibilidad</h1>

<div class="container">
    <div id="calendar"></div>
    <div class="time-selection">
        <label for="start-time">Hora de inicio:</label>
        <input type="time" id="start-time" name="start-time">
        <label for="end-time">Hora de fin:</label>
        <input type="time" id="end-time" name="end-time">
        <button id="update-btn">Actualizar</button>
    </div>
</div>

<?php include '../templates/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                $('#start-time').val(start.format('HH:mm'));
                $('#end-time').val(end.format('HH:mm'));
                var selectedDate = start.format('YYYY-MM-DD');
                $('#calendar').data('selectedDate', selectedDate);
                $('#calendar').fullCalendar('unselect');
            },
            editable: true,
            eventLimit: true,
            events: [
                <?php foreach ($disponibilidad as $disp): ?>
                {
                    title: 'Disponible',
                    start: '<?php echo $disp["Fecha"] . "T" . $disp["HoraInicio"]; ?>',
                    end: '<?php echo $disp["Fecha"] . "T" . $disp["HoraFin"]; ?>'
                },
                <?php endforeach; ?>
            ]
        });

        $('#update-btn').click(function() {
            var startTime = $('#start-time').val();
            var endTime = $('#end-time').val();
            var selectedDate = $('#calendar').data('selectedDate');

            if (!selectedDate) {
                alert('Por favor, selecciona una fecha en el calendario.');
                return;
            }

            var eventData = {
                title: 'Disponible',
                start: selectedDate + 'T' + startTime,
                end: selectedDate + 'T' + endTime
            };
            $('#calendar').fullCalendar('renderEvent', eventData, true);

            $.ajax({
                url: 'updateDisponibilidad.php',
                method: 'POST',
                data: {
                    fecha: selectedDate,
                    hora_inicio: startTime,
                    hora_fin: endTime
                },
                success: function(response) {
                    if (response === 'success') {
                        alert('Disponibilidad actualizada correctamente.');
                    } else {
                        alert('Error al actualizar la disponibilidad.');
                    }
                },
                error: function() {
                    alert('Error al actualizar la disponibilidad.');
                }
            });
        });
    });
</script>
</body>
</html>