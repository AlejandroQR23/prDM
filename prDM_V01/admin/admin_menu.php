<!-- Con este codigo php logras saber si el hay una sesión iniciada -->
<?php

    session_start();

    include("../db.php");

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
        <title> Menu Admin </title>
        <link rel = "stylesheet" href = "/prDM_V01/assets/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>

        <?php require '../partials/header.php' ?>

        <?php if( !empty($user) ): ?>

          <h1> <a href = "report_reserva.php"> Obtener reporte de reservas </a> </h1>

            <h1> <a href = "hab_admin.php"> Administrar habitaciones </a> </h1>

            <h1> <a href = "convert_admin.php"> Volver un usuario administrador </a> </h1>

            <a href = "../logout.php"> Cerrar sesión </a>

        <?php else: ?>

            <h1> Seleccione una opción </h1>
            <a href = "../login.php"> Iniciar sesión </a> o
            <a href = "../signup.php"> Registrarse </a>

        <?php endif; ?>

    </body>

</html>
