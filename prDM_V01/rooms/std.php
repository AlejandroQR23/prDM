<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <title> Estándar </title>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "/prDM_V01/assets/styles.css">
    </head>

    <body>

        <?php require "../partials/header.php" ?>

        <h1> Habitación estándar </h1>

        <p> Hospédate en una de nuestras habitaciones estándar
            por un precio accesible </p>

        <ul class = "gallery">
            <li><a href="#img1"> <img src = "/prDM_V01/img/std/hab.jpg"> </a></li>
            <li><a href="#img2"> <img src = "/prDM_V01/img/std/bath.jpg"> </a></li>
            <li><a href="#img3"> <img src = "/prDM_V01/img/std/tv.jpg"> </a></li>
        </ul>

        <div class = "modal" id = "img1">
            <h3> Habitación estándar </h3>
            <div class= "image">
                <a href="#img3"> &#60; </a>
                <a href="#img2"> <img src = "/prDM_V01/img/std/hab.jpg"> </a>
                <a href="#img2"> > </a>
            </div>
            <a class="close" href=""> X </a>
        </div>

        <div class="modal" id="img2">
            <h3> Baño </h3>
            <div class= "image">
                <a href="#img1"> &#60; </a>
                <a href="#img3"> <img src = "/prDM_V01/img/std/bath.jpg"> </a>
                <a href="#img3"> > </a>
            </div>
            <a class="close" href=""> X </a>
        </div>

        <div class="modal" id="img3">
            <h3> TV </h3>
            <div class= "image">
                <a href="#img2"> &#60; </a>
                <a href="#img1"> <img src = "/prDM_V01/img/std/tv.jpg"> </a>
                <a href="#img1"> > </a>
            </div>
            <a class="close" href=""> X </a>
        </div>

        <?php
            $hab = 1;
            require "../partials/services.php"
        ?>

    </body>

</html>
