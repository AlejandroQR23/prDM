<?php

    session_start();

    require "db.php";
    require 'partials/calculoC.php';

    ini_set( 'display_errors', 0 );

    # Variables del formulario
    $address = $_GET['address'];
    $cid = $_GET['start_d'];
    $cod = $_GET['end_d'];
    $type = $_GET['room'];
    $s1 = $_GET['s1'];
    $s2 = $_GET['s2'];
    $s3 = $_GET['s3'];
    $unam = $_GET['unam'];
    $inapam = $_GET['inapam'];

    # Verificar sesión de usuario
    if( isset($_SESSION['user_id']) ){

        $records = $conn->prepare('SELECT id, name, email, pswd FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if( count($results) > 0 ){
            $user = $results;
        }

    }

    # Disponibilidad de habitaciones
    $disponible = true;

    $consult = $conn->prepare('SELECT * FROM rooms');
    $consult->execute();
    $results = $consult->fetchAll(PDO::FETCH_ASSOC);

    # Formato para comparar
    $ci_d = strtotime( $cid );
    $co_d = strtotime( $cod );

    #Formato para mySQL
    $cin = date('Y-m-d', $ci_d);
    $cout = date('Y-m-d', $co_d);

    if( $type == 2 ){ $type = 1; }
    foreach ($results as $room) {

        $check_out = strtotime( $room['check_out'] );
        if( $ci_d > $check_out && $type == $room['type'] ){

            # Bandera de disponibilidad
            $disponible = true;

            # Modifica las fechas en la tabla de habitaciones
            $id = $room['id'];
            $mod = $conn->prepare("UPDATE rooms SET check_in='$cin', check_out='$cout', occupied='1' WHERE id='$id'");
            $mod->execute();

            break;
        } else { $disponible = false; }

    }

    # Costo total de facturación
    function factura( $disponible ){

        if( $disponible ){
            $hab = 0;
            if( $_GET['room'] == 1 ){
                $hab = 1000;
            } elseif ( $_GET['room'] == 2 ) {
                $hab = 1500;
            } else {
                $hab = 3000;
            }

            # Cálculo de días de hospedaje
            $cin = new DateTime( $_GET['start_d'] );
            $cout = new DateTime( $_GET['end_d'] );
            $diff = $cin->diff( $cout );
            $days = $diff->days;

            $servicios = services( $_GET['s1'], $_GET['s2'], $_GET['s3'], $days );
            $descuento = discount( $_GET['inapam'], $_GET['unam'], 1000 );
            $costo = cost( $hab, $days, $servicios, $descuento );

            return $costo;
        }

    }

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <title> Factura </title>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "assets/styles.css">
    </head>

    <body>

        <?php require 'partials/header.php' ?>

        <h1> Factura </h1>

        <p> Lee con atención los detalles del servicio que has solicitado. <br>
            Si estás de acuerdo, pulsa el botón de confirmación para confirmar tu reserva
            y generar tu factura. </p>

        <?php $costo = factura( $disponible ); ?>

        <br> Nombre: <?= $user['name']; ?>
        <br> Habitación: <?= $_GET['room']; ?>
        <br> Dirección: <?= $address; ?>
        <br> Fecha de inicio: <?= $_GET['start_d']; ?>
        <br> Fecha de salida: <?= $_GET['end_d']; ?>
        <br> Costo: <?= $costo;  ?><br>

        <br><form action="reporte.php" method="get">
            <input type = "hidden" name = "address" value = "<?= isset($address)?htmlspecialchars($address):'' ?>">
            <input type = "hidden" name = "cid" value = "<?= isset($cid)?htmlspecialchars($cid):'' ?>">
            <input type = "hidden" name = "cod" value = "<?= isset($cod)?htmlspecialchars($cod):'' ?>">
            <input type = "hidden" name = "type" value = "<?= isset($_GET['room'])?htmlspecialchars($_GET['room']):'' ?>">
            <input type = "hidden" name = "s1" value = "<?= isset($s1)?htmlspecialchars($s1):'' ?>">
            <input type = "hidden" name = "s2" value = "<?= isset($s2)?htmlspecialchars($s2):'' ?>">
            <input type = "hidden" name = "s3" value = "<?= isset($s3)?htmlspecialchars($s3):'' ?>">
            <input type = "hidden" name = "unam" value = "<?= isset($unam)?htmlspecialchars($unam):'' ?>">
            <input type = "hidden" name = "inapam" value = "<?= isset($inapam)?htmlspecialchars($inapam):'' ?>">
            <input type = "hidden" name = "costo" value = "<?= isset($costo)?htmlspecialchars($costo):'' ?>">
            <input type = "submit" name = "confirm" value = "Confirmar" <?php if( !$disponible ){ echo 'disabled'; } ?> >
        </form>

    </body>

</html>
