<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="../css/factura.css">
</head>
<body>

<?php include '../templates/headerClient.php'; ?>

    <div class="container">
<div class="invoice-form">
    <h2>FACTURACION DEL SERVICIO</h2>
    <form>
        <label for="client">Cliente:</label>
        <input type="text" id="client" name="client" required>

        <label for="address">Direccion:</label>
        <input type="text" id="address" name="address" required>

        <label for="service">Servicio:</label>
        <input type="text" id="service" name="service" required>
  
        <label for="serviceDateTime">Fecha y Hora del servicio:</label>
        <input type="datetime-local" id="serviceDateTime" name="serviceDateTime" required>

        <label for="serviceId">ID del servicio:</label>
        <input type="text" id="serviceId" name="serviceId" required>

        <h3>Detalles del producto</h3>
        <table>
            <thead>
                <tr>
                    <th>Cantidad usada</th>
                    <th>Nombre del suministro</th>
                    <th>Unidad de medida</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" name="quantity1" required></td>
                    <td><input type="text" name="productName1" required></td>
                    <td><input type="text" name="unit1" required></td>
                    <td><input type="number" step="0.01" name="cost1" required></td>
                </tr>
                <tr>
                    <td><input type="number" name="quantity2"></td>
                    <td><input type="text" name="productName2"></td>
                    <td><input type="text" name="unit2"></td>
                    <td><input type="number" step="0.01" name="cost2"></td>
                </tr>
                <tr>
                    <td><input type="number" name="quantity3"></td>
                    <td><input type="text" name="productName3"></td>
                    <td><input type="text" name="unit3"></td>
                    <td><input type="number" step="0.01" name="cost3"></td>
                </tr>
            </tbody>
        </table>
        <h3>Cargos extra</h3>
        <label for="transportation">Transporte:</label>
        <input type="number" step="0.01" id="transportation" name="transportation" required>

        <label for="labor">Mano de obra:</label>
        <input type="number" step="0.01" id="labor" name="labor" required>

        <label for="paymentMethod">Metodo de pago:</label>
        <select id="paymentMethod" name="paymentMethod" required>
            <option value="">Selecciona un metodo</option>
            <option value="creditCard">Tarjeta de Credito </option>
            <option value="debitCard">Tarjeta de Debito </option>
            <option value="cash">Efectivo</option>
            <option value="bankTransfer">Transferencia bancaria</option>
        </select>

        <label for="cardHolderName">Nombre del titular:</label>
        <input type="text" id="cardHolderName" name="cardHolderName" required>

        <label for="cardLastDigits">Ultimos digitos de la tarjeta:</label>
        <input type="text" id="cardLastDigits" name="cardLastDigits" maxlength="4" required>

        <h3>Total </h3>
        <input type="number" step="0.01" id="totalAmount" name="totalAmount" readonly>

        <button type="submit">Hecho</button>
    </form>
</div></div>

<?php include '../templates/footer.php'; ?>


</body>
</html>
