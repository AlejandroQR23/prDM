<?php

    session_start();

    include("../db.php");

    $cross ="../img/icons/crosspre.png";
    $check ="../img/icons/checkpre.png";

    if ( !empty( $_POST['id'] ) ) {
      $id = $_POST['id'];
    }

    if ( !empty( $_POST['occupied'] ) ) {

      $occupied = $_POST['occupied'];
      $sql = "UPDATE rooms SET occupied=$occupied WHERE id='$id'";
      $stmt = $conn->prepare( $sql );

      if( !empty( $stmt ) && $stmt->execute() ){
          $message = 'Modificación realizada exitosamente';
      } else {
          $message = 'Ha ocurrido un error';
      }

    }

    if ( !empty( $_POST['cleanning'] ) ) {

      $cleanning = $_POST['cleanning'];
      $sql = "UPDATE rooms SET cleanning=$cleanning WHERE id='$id'";
      $stmt = $conn->prepare( $sql );

      if( !empty( $stmt ) && $stmt->execute() ){
          $message = 'Modificación realizada exitosamente';
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
        <title> Administrar habitaciones </title>
        <link rel = "stylesheet" href = "/prDM_V01/assets/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>

        <?php require '../partials/header.php' ?>

        <h1> Administrar habitaciones </h1>

        <?php if( !empty($message) ): ?>
            <p> <?= $message ?> </p>
        <?php endif; ?>

        <table>

        <tr>
          <th> ID de la habitación </th>
          <th> Tipo de habitación </th>
          <th> Ocupada </th>
          <th> En limpieza </th>
        </tr>

        <?php
          $query = "SELECT id, type, occupied, cleanning FROM rooms";
          $data = $conn->query($query);
          try {
            $data->setFetchMode(PDO::FETCH_ASSOC);
          } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
          }
          foreach($data as $row){
            print "<tr>";
            foreach ($row as $name=>$value){
                if( $name == "id" ) {
                    $id = $value;
                    print " <td>$value</td>";
                } elseif( $name == "occupied" ){
                    if ( $value == "1" ) {
                        $occupied = "FALSE";
                        print "<td> <img src=$check alt='Check' style='width:40px;height:40px;' > <br>";
                    } elseif ( $value == "0" ) {
                        $occupied = "TRUE";
                        print "<td> <img src=$cross alt='cross' style='width:40px;height:40px;' > <br>";
                    }
                    print "<form method='post' action='hab_admin.php'>
                      <input type='hidden' name='id' value='$id'>
                      <input type='hidden' name='occupied' value='$occupied'>
                      <input type='submit' value='Cambiar Estado'>
                      </form>
                    </td>";
                } elseif( $name == "cleanning" ){
                    if ( $value == "1" ) {
                        $cleanning = "FALSE";
                        print "<td> <img src=$check alt='Check' style='width:40px;height:40px;' > <br>";
                    } elseif ( $value == "0" ) {
                        $cleanning = "TRUE";
                        print "<td> <img src=$cross alt='cross' style='width:40px;height:40px;' > <br>";
                    }
                    print "<form method='post' action='hab_admin.php'>
                      <input type='hidden' name='id' value='$id'>
                      <input type='hidden' name='cleanning' value='$cleanning'>
                      <input type='submit' value='Cambiar Estado'>
                      </form>
                    </td>";
                } else {
                print " <td>$value</td>";
                }
            }// end field loop
            print " </tr>";
          } // end record loop
        ?>

        </table>
        <p> Tipo 1 es la habitacion estandar <br>
         Tipo 2 es la habitacion Junior Suit </p>

    </body>

</html>
