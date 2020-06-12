
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
        <title> Bienvenido a El Descanso Medieval </title>
        <link rel = "stylesheet" href = "assets/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>

        <?php require 'partials/header.php' ?>

        <?php if( !empty($user) ): ?>

            <br> Bienvenido, <?= $user['name']; ?>
            <a href = "#"> Cerrar sesión </a>

        <?php else: ?>

            <h1> VISITANOS </h1>
            <p> Ni los europeos lograron descansar tan bien luego de la peste negra como tú
                lo harás en nuestras cómodas habitaciones. </p>

            <img src = "img/hotel.jpg">

        <?php endif; ?>

    </body>
