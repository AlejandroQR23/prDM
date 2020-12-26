
<?php

    require 'db.php';

    $message = '';

    if( !empty( $_POST['email'] ) && !empty( $_POST['pswd'] ) ){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pswd = password_hash( $_POST['pswd'], PASSWORD_BCRYPT );
        $sql = "INSERT INTO users (name, email, pswd, admin) VALUES ('$name', '$email', '$pswd', '0')";
        $stmt = $conn->prepare( $sql );

        if( $stmt->execute() ){
            $message = 'Usuario creado exitosamente';
        } else {
            $message = 'Ha ocurrido un error';
        }

    }

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <title> Registrarse </title>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "assets/styles.css">
    </head>

    <body>

        <?php require 'partials/header.php' ?>

        <?php if( !empty($message) ): ?>
            <p> <?= $message ?> </p>
        <?php endif; ?>

        <h1> Registrate </h1>
        <span>o <a href = "login.php">Inicia sesión</a></span>

        <form action = "signup.php" method = "POST">
            <input type = "text" name = "name" placeholder = "Ingresa tu nombre">
            <input type = "text" name = "email" placeholder = "Ingresa tu correo">
            <input type = "password" name = "pswd" placeholder = "Ingresa tu contraseña">
            <input type = "password", name = "confirm_pswd" placeholder = "Confirmar contraseña">
            <input type = "submit" value = "Enviar">
        </form>

    </body>

</html>
