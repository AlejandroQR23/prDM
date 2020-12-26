<?php

    session_start();

    require "db.php";

    $userid = $_SESSION['user_id'];

    if ( !empty( $_POST['action'] ) ) {

      $delete_id = $_POST['action'];
      $sql = "DELETE FROM `books` WHERE `books`.`id` = $delete_id";
      $stmt = $conn->prepare( $sql );

      if( $stmt->execute() ){
          $message = 'Reservasion eliminada exitosamente';
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
        <title> Cancelar reservación </title>
        <link rel = "stylesheet" href = "assets/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">

    <body>

        <?php require 'partials/header.php' ?>

        <h1> Cancelar Reservacion </h1>

        <?php if( !empty($message) ): ?>
            <p> <?= $message ?> </p>
        <?php endif; ?>

        <table>

        <tr>
          <th> ID de la reservación </th>
          <th> ID de la habitación </th>
          <th> Tipo de habitación </th>
          <th> Fecha de entrada </th>
          <th> Fecha de salida </th>
          <th> Boton de eliminacion </th>
        </tr>

        <?php
          $query = "SELECT id, room, type, check_in, check_out FROM books WHERE userid = '$userid'";
          $data = $conn->query($query);
          try {
            $data->setFetchMode(PDO::FETCH_ASSOC);
          } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
          }
          foreach($data as $row){
            print "<tr>";
            foreach ($row as $name=>$value){
              if( $name == "id" ){
                $to_delete = $value;
              }
              print " <td>$value</td>";
            }// end field loop
            print "<td><form method='post' action='borrar_reserva.php'>
                  <input type='hidden' name='action' value='$to_delete'>
                  <input type='submit' value='Eliminar reservacion'>
                  </form><td>";
            print " </tr>";
          } // end record loop
        ?>

        </table>
        <p> Tipo 1 es la habitacion estandar <br>
         Tipo 2 es la habitacion Junior Suit </p>

    </body>

</html>
