
<!DOCTYPE html>
<html>

    <head>
        <meta charset = "utf-8">
        <title> Jr-Suite </title>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">


        <link rel = "stylesheet" href = "/prDM_V01/assets/styles.css">
    </head>

    <body>

        <?php require "../partials/header.php" ?>

        <h1> Jr-Suite </h1>

        <p> Si estás cansado de convivir con la gente de clase común,
            te recomendamos nuestras exclusivas Jr-Suite. Donde te podrás
            hospedar como todo un fifí </p>

        <ul class = "gallery">
            <li><a href="#img1"> <img src = "/prDM_V01/img/jr/hab_jr.jpg"> </a></li>
            <li><a href="#img2"> <img src = "/prDM_V01/img/jr/bath_jr.jpg"> </a></li>
            <li><a href="#img3"> <img src = "/prDM_V01/img/jr/balcon.jpg"> </a></li>
        </ul>

        <div class = "modal" id = "img1">
            <h3> Habitación estándar </h3>
            <div class= "image">
                <a href="#img3"> &#60; </a>
                <a href="#img2"> <img src = "/prDM_V01/img/jr/hab_jr.jpg"> </a>
                <a href="#img2"> > </a>
            </div>
            <a class="close" href=""> X </a>
        </div>

        <div class="modal" id="img2">
            <h3> Baño </h3>
            <div class= "image">
                <a href="#img1"> &#60; </a>
                <a href="#img3"> <img src = "/prDM_V01/img/jr/bath_jr.jpg"> </a>
                <a href="#img3"> > </a>
            </div>
            <a class="close" href=""> X </a>
        </div>

        <div class="modal" id="img3">
            <h3> Balcón </h3>
            <div class= "image">
                <a href="#img2"> &#60; </a>
                <a href="#img1"> <img src = "/prDM_V01/img/jr/balcon.jpg"> </a>
                <a href="#img1"> > </a>
            </div>
            <a class="close" href=""> X </a>
        </div>

        <?php
            $hab = 3;
            require "../partials/services.php"
        ?>


    </body>

</html>
