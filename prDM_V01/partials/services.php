
<p> Recuerda que si decides quedarte con nosotros
    por 3 noches o más se te aplicará un 20% de descuento sobr el costo
    de la habitación. Si decides quedarte por más de 10 noches este descuento
    será del 50%. </p><br>

<h2> Para continuar con su reserva ingrese los
    siguientes datos. </h2>

<form class = "formulario" action = "/prDM_V01/factura.php" method = "GET">

    <input type = "text" name = "address" placeholder = "Ingresa tu dirección" required>
    <input type = "text" name = "inapam" placeholder = "Ingresa tu tarjeta INAPAM (si la tienes)">
    <input type = "text" name = "unam" placeholder = "Ingresa tu credencial UNAM (si la tienes)">
    <input type = "password" name = "card" placeholder = "Ingresa tu tarjeta (deja en blanco para pagar en efectivo)">
    <label for = "start"> Fecha de inicio </label> <input type = "date" name = "start_d" id = "start" required>
    <label for = "end"> Fecha de salida </label> <input type = "date" name = "end_d" id = "end" required>

    <label> Servicios </label>

    <div class="radio" >
        <input type = "radio" value = "100" name = "s1" id = "s1"> <label for = "s1"> gym </label>
        <input type = "radio" value = "100" name = "s2" id = "s2"> <label for = "s2"> zumba </label>
        <input type = "radio" value = "100" name = "s3" id = "s3"> <label for = "s3"> yoga </label>
    </div>

    <input type = "hidden" name = "room" value = "<?= isset($hab)?htmlspecialchars($hab):'' ?>">
    <br><input type = "submit" value = "Enviar">

</form>
