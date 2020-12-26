<?php

    include("../db.php");

    session_start();

    $message = '';

    if( !empty( $_POST['name'] ) && !empty( $_POST['type'] ) ){

        $name = $_POST['name'];
        $type = $_POST['type'];
        $sql = "UPDATE users SET admin=$type WHERE name='$name'";
        $stmt = $conn->prepare( $sql );

        if( $stmt->execute() ){
            $message = 'Usuario modificado exitosamente';
        } else {
            $message = 'Ha ocurrido un error';
        }

    }

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <title> Añadir admin </title>
        <link rel = "stylesheet" href = "/prDM_V01/assets/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>

        <?php require '../partials/header.php' ?>

        <h1> Lista de usuarios </h1>
        <p>
          Escoja un nombre de un usuario que desee volver administrador de la siguiente lista e ingréselo en el recuadro siguiente para cambiar el estado de dicho usuario.
        </p>

        <form action = "convert_admin.php" method = "POST">
            <input type = "text" name = "name" placeholder = "Ingresa el nombre del usuario">
            <input type="radio" name="type" value="TRUE"> Dar Perimisos administrador <br>
            <input type="radio" name="type" value="FALSE"> Quitar permisos de adminitrador <br>
            <br>
            <input type = "submit" value = "Enviar">
        </form>

        <?php if( !empty($message) ): ?>
            <p> <?= $message ?> </p>
        <?php endif; ?>

        <br>

        <p>
          <table>
            <tr>
              <th> Nombre de usuario </th>
              <th> E-mail </th>
              <th> Admin status </th>
            </tr>
            <?php
                //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $cross ="../img/icons/crosspre.png";
                $check ="../img/icons/checkpre.png";
                $query = "SELECT name, email, admin FROM users";
                $data = $conn->query($query);
                try {
                  $data->setFetchMode(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                  echo 'ERROR: ' . $e->getMessage();
                }
                foreach($data as $row){
                  print "<tr>";
                  foreach ($row as $name=>$value){
                    if ( $value == "1" ) {
                      print "<td> <img src=$check alt='Check' style='width:40px;height:40px;' > </td>";
                    } elseif ( $value == "0" ) {
                      print "<td> <img src=$cross alt='cross' style='width:40px;height:40px;' > </td>";
                    } else {
                    print " <td>$value</td>";
                    }
                  } // end field loop
                  print " </tr>";
                } // end record loop
            ?>

          </table>
        </p>

    </body>

</html>
