
<?php

    $server = 'localhost';
    $username = 'root';
    $pswd = '';
    $db = 'login_db';

    # conexion a la base de datos
    try {
        $conn = new PDO("mysql:host=$server;dbname=$db;", $username, $pswd);
    } catch ( PDOException $e ){
        die( 'Connection Failed: ' . $e->getMessage() );
    }

?>
