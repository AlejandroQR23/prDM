<!-- Con este codigo php logras saber si el hay una sesión iniciada -->
<?php

    session_start();

    require "db.php";

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

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <title> Reservaciones </title>
        <link rel = "stylesheet" href = "assets/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>

        <?php require 'partials/header.php' ?>

        <?php if( !empty($user) ): ?>

            <h1> Selecciona una habitación </h1>
            <p> Obtén unas vacaciones medievales y un descanso europeo en nuestras
                cómodas habitaciones </p>

            <ul id = "rooms">
                <li>
                    <a href="rooms/std.php"> <img src = "img/h_std.jpg" height = 30% width= 30%> </a>
                </li>
                <li>
                    <a href="rooms/std_f.php"> <img src = "img/stdf.jpg" height = 30% width= 30%> </a>
                </li>
                <li>
                    <a href="rooms/jr_suite.php"> <img src = "img/jr.jpg" height = 30% width= 30%> </a>
                </li>
            </ul>

            <p> <i>Cada habitación cuenta con acceso a dos computadoras y una impresora.</i> </p>

            <br><a href = "borrar_reserva.php"> Cancelar reservación </a><br>
            <a href = "logout.php"> Cerrar sesión </a>


        <?php else: ?>

            <h1> Seleccione una opción </h1>
            <a href = "login.php"> Iniciar sesión </a> o
            <a href = "signup.php"> Registrarse </a>

        <?php endif; ?>

    </body>

</html>
