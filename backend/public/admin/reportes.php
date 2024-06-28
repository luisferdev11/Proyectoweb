<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="../css/reportes.css">
</head>
<body>
    
<?php include '../templates/headeradmin.php'; ?>

    <div class="container">
        <h1>Reportes pendientes</h1>
        <div class="report-container">
            <div class="report-card">
                <p><strong>ID:</strong></p>
                <p><strong>Fecha:</strong></p>
                <p><strong>Servicio:</strong></p>
                <p><strong>Cliente:</strong></p>
                <p><strong>Dirección:</strong></p>
                <p><strong>Total:</strong></p>
                <p><strong>Observaciones:</strong></p>
                <textarea rows="4"></textarea>
                <button class="btn btn-primary" onclick="showReportForm()">Generar Reporte</button>
            </div>
            <div class="report-card">
                <p><strong>ID:</strong></p>
                <p><strong>Fecha:</strong></p>
                <p><strong>Servicio:</strong></p>
                <p><strong>Cliente:</strong></p>
                <p><strong>Dirección:</strong></p>
                <p><strong>Total:</strong></p>
                <p><strong>Observaciones:</strong></p>
                <textarea rows="4"></textarea>
                <button class="btn btn-primary" onclick="showReportForm()">Generar Reporte</button>
            </div>
            <div class="report-card">
                <p><strong>ID:</strong></p>
                <p><strong>Fecha:</strong></p>
                <p><strong>Servicio:</strong></p>
                <p><strong>Cliente:</strong></p>
                <p><strong>Dirección:</strong></p>
                <p><strong>Total:</strong></p>
                <p><strong>Observaciones:</strong></p>
                <textarea rows="4"></textarea>
                <button class="btn btn-primary" onclick="showReportForm()">Generar Reporte</button>
            </div>
            <div class="report-card">
                <p><strong>ID:</strong></p>
                <p><strong>Fecha:</strong></p>
                <p><strong>Servicio:</strong></p>
                <p><strong>Cliente:</strong></p>
                <p><strong>Dirección:</strong></p>
                <p><strong>Total:</strong></p>
                <p><strong>Observaciones:</strong></p>
                <textarea rows="4"></textarea>
                <button class="btn btn-primary" onclick="showReportForm()">Generar Reporte</button>
            </div>
            <div class="report-card">
                <p><strong>ID:</strong></p>
                <p><strong>Fecha:</strong></p>
                <p><strong>Servicio:</strong></p>
                <p><strong>Cliente:</strong></p>
                <p><strong>Dirección:</strong></p>
                <p><strong>Total:</strong></p>
                <p><strong>Observaciones:</strong></p>
                <textarea rows="4"></textarea>
                <button class="btn btn-primary" onclick="showReportForm()">Generar Reporte</button>
            </div>
        </div>
    </div>

    <div id="reportForm" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeReportForm()">&times;</span>
            <h2>Generar Reporte</h2>
            <div class="supply-list">
                <div class="supply-item">
                    <input type="text" placeholder="Nombre de suministro">
                    <input type="number" placeholder="Cantidad">
                    <select>
                        <option value="m">m</option>
                        <option value="pieza">Pieza</option>
                    </select>
                    <button class="btn btn-danger">-</button>
                </div>
                <div class="supply-item">
                    <input type="text" placeholder="Nombre de suministro">
                    <input type="number" placeholder="Cantidad">
                    <select>
                        <option value="m">m</option>
                        <option value="pieza">Pieza</option>
                    </select>
                    <button class="btn btn-danger">-</button>
                </div>
                <button class="btn btn-success">+</button>
            </div>
            <div class="upload">
                <button class="btn">Cargar evidencia fotográfica</button>
            </div>
            <div class="actions">
                <button class="btn btn-danger" onclick="closeReportForm()">Cancelar</button>
                <button class="btn btn-success">Reportar</button>
            </div>
        </div>
    </div>

    <?php include '../templates/footer.php'; ?>


</body>
<script>
        function showReportForm() {
            document.getElementById("reportForm").style.display = "block";
        }

        function closeReportForm() {
            document.getElementById("reportForm").style.display = "none";
        }

    </script>
</html>
