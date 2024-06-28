<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Suministros</title>
    <link rel="stylesheet" href="../css/gestionSuministro.css">
</head>
<body>
<?php include '../templates/headeradmin.php'; ?>


    <div class="container">
        <h1>Actualización de suministros</h1>
        <div class="supplies-container">
            <table>
                <thead>
                    <tr>
                        <th>ID del suministro</th>
                        <th>Nombre del suministro</th>
                        <th>Cantidad</th>
                        <th>Unidad de medida</th>
                        <th>Cantidad mínima</th>
                        <th>Cantidad máxima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Datos estáticos
                    $supplies = [
                        ["id" => 151, "nombre" => "Tubo", "cantidad" => "10", "unidad" => "m", "minima" => "5", "maxima" => "50"],
                        ["id" => 565, "nombre" => "Manguera", "cantidad" => "8", "unidad" => "m", "minima" => "3", "maxima" => "30"],
                        ["id" => 789, "nombre" => "Cinta", "cantidad" => "1", "unidad" => "pieza", "minima" => "1", "maxima" => "10"],
                        ["id" => 345, "nombre" => "Llave inglesa", "cantidad" => "15", "unidad" => "pieza", "minima" => "5", "maxima" => "20"],
                        ["id" => 456, "nombre" => "Destornillador", "cantidad" => "12", "unidad" => "pieza", "minima" => "6", "maxima" => "25"],
                        ["id" => 678, "nombre" => "Martillo", "cantidad" => "7", "unidad" => "pieza", "minima" => "2", "maxima" => "15"],
                        ["id" => 234, "nombre" => "Pinzas", "cantidad" => "5", "unidad" => "pieza", "minima" => "2", "maxima" => "10"],
                        ["id" => 890, "nombre" => "Serrucho", "cantidad" => "3", "unidad" => "pieza", "minima" => "1", "maxima" => "5"],
                        ["id" => 912, "nombre" => "Taladro", "cantidad" => "4", "unidad" => "pieza", "minima" => "1", "maxima" => "6"]
                    ];

                    // Generar filas de la tabla con datos estáticos
                    foreach ($supplies as $supply) {
                        echo "<tr>
                                <td>{$supply['id']}</td>
                                <td><input type='text' value='{$supply['nombre']}' readonly></td>
                                <td><input type='text' value='{$supply['cantidad']}'></td>
                                <td><input type='text' value='{$supply['unidad']}'></td>
                                <td><input type='text' value='{$supply['minima']}'></td>
                                <td><input type='text' value='{$supply['maxima']}'></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="actions">
            <button class="btn btn-primary">Suministrar el almacén</button>
            <button class="btn btn-secondary">Descargar en PDF</button>
        </div>
    </div>



    

    <?php include '../templates/footer.php'; ?>

</body>

</html>