<?php
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../controllers/CursoController.php';

checkSessionAndRole('empleado');

$controller = new CursoController();
$cursos = $controller->getCursosPorEmpleado($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'Nombre' => $_POST['nombre'],
        'Organizacion' => $_POST['organizacion'],
        'NumeroEmpleado' => $_SESSION['user_id'],
        'FechaExpedicion' => $_POST['ano_emision'] . '-' . $_POST['mes_emision'] . '-01',
        'FechaExpiracion' => $_POST['ano_expiracion'] . '-' . $_POST['mes_expiracion'] . '-01',
        'Descripcion' => $_POST['descripcion']
    ];

    $result = $controller->agregarCurso($data);

    if ($result) {
        header("Location: cursos.php");
        exit();
    } else {
        echo "Error al agregar el curso.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos de los Trabajadores</title>
    <link rel="stylesheet" href="../css/cursosTrabajadores.css">
</head>
<body>
<?php include '../templates/headerWorker.php'; ?>

<div class="container">
    <h1>Mis Cursos y Certificaciones</h1>
    <?php foreach ($cursos as $curso): ?>
    <div class="curso-card">
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($curso['nombre']); ?></p>
        <p><strong>Organización:</strong> <?php echo htmlspecialchars($curso['organizacion']); ?></p>
        <p><strong>Fecha de Emisión:</strong> <?php echo htmlspecialchars($curso['fechaexpedicion']); ?></p>
        <p><strong>Fecha de Expiración:</strong> <?php echo htmlspecialchars($curso['fechaexpiracion']); ?></p>
        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($curso['descripcion']); ?></p>
    </div>
    <?php endforeach; ?>
    <button class="btn btn-primary" onclick="openModal()">Agregar Curso</button>
</div>

<!-- Modal para agregar curso -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Agregar Curso o Certificación</h2>
        <form action="cursos.php" method="POST">
            <label for="nombre">Nombre*</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ex: Microsoft certified network associate security" required><br>
            <label for="organizacion">Organización emisora*</label>
            <input type="text" id="organizacion" name="organizacion" placeholder="Ex: Microsoft" required><br>
            <label for="fecha_emision">Fecha de emisión</label><br>
            <select id="mes_emision" name="mes_emision" required>
                <option value="">Mes</option>
                <!-- Add months here -->
                <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                <?php endfor; ?>
            </select>
            <select id="ano_emision" name="ano_emision" required>
                <option value="">Año</option>
                <!-- Add years here -->
                <?php for ($i = date("Y"); $i >= 1980; $i--): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select><br>
            <label for="fecha_expiracion">Fecha de expiración</label><br>
            <select id="mes_expiracion" name="mes_expiracion" required>
                <option value="">Mes</option>
                <!-- Add months here -->
                <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                <?php endfor; ?>
            </select>
            <select id="ano_expiracion" name="ano_expiracion" required>
                <option value="">Año</option>
                <!-- Add years here -->
                <?php for ($i = date("Y"); $i >= 1980; $i--): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select><br>
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" placeholder="Describe el curso o certificación"></textarea><br>
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="button" class="btn btn-danger" onclick="closeModal()">Cancelar</button>
        </form>
    </div>
</div>

<?php include '../templates/footer.php'; ?>

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
