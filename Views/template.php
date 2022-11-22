<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tejidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Views/css/headers.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"> -->
</head>

<body>

    <?php

    if (isset($_SESSION["Ingreso"]) && $_SESSION["Ingreso"] == TRUE) {

        //   include "modulos/menu.php";
        //   include "modulos/cabeceras.php";
    
        if (isset($_GET["url"])) {

            include "navbar.php";
            if ($_GET["url"] == "home") {


                include "modules/home/" . $_GET["url"] . ".php";

            } else if ($_GET["url"] == "organitations") {


                include "modules/organitations/" . $_GET["url"] . ".php";

            }



        } else {
            include "modules/home/home.php";
        }

    } else {
        include "modules/login.php";
    }



    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>

    <?php

    if (isset($_SESSION["Ingreso"]) && $_SESSION["Ingreso"] == TRUE) {
        if (isset($_GET["url"])) {
            if ($_GET["url"] == "home") {

                echo '<script src="Views/js/app/home/' . $_GET["url"] . '.js" type="module"></script>';

            } else if ($_GET["url"] == "organitations") {


                echo '<script src="Views/js/app/organitations/' . $_GET["url"] . '.js" type="module"></script>';

            }

        }
    }
    ?>

</body>

</html>