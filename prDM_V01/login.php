<?php

    session_start();

    require 'db.php';

    if( !empty( $_POST['email'] ) && !empty( $_POST['pswd'] ) ){
        $records = $conn->prepare('SELECT id, email, pswd, admin FROM users WHERE email = :email');
        $records->bindParam( ':email', $_POST['email'] );
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if( count($results) > 0 && password_verify( $_POST['pswd'], $results['pswd'] ) ){
            $_SESSION['user_id'] = $results['id'];
            $_SESSION['admin'] = $results['admin'];
            if( $results['admin'] ){
                header("Location: /prDM_V01/admin/admin_menu.php");
            } else {
                header("Location: /prDM_V01/reserva.php");
            }
        } else {
            $message = 'Usuario o contraseña incorrectos';
        }
    }

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <title> Iniciar sesion </title>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "assets/styles.css">
    </head>

    <body>

        <?php require 'partials/header.php' ?>

        <?php if( !empty($message) ): ?>
            <p> <?= $message ?> </p>
        <?php endif; ?>

        <h1> Iniciar sesion </h1>
        <span>o <a href = "signup.php"> Registrate </a></span>

        <form action = "login.php" method = "POST">
            <input type = "text" name = "email" placeholder = "Ingresa tu correo">
            <input type = "password" name = "pswd" placeholder = "Ingresa tu contraseña">
            <input type = "submit" value = "Enviar">
        </form>

    </body>

</html>
