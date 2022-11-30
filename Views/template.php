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
    <!--DATA TABLES-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <?php

    if (isset($_SESSION["Ingreso"]) && $_SESSION["Ingreso"] == TRUE) {
        if (isset($_GET["url"])) {

            include "navbar.php";

            if ($_GET["url"] == "exit") {
                include "exit.php";

            } else if ($_GET["url"] == "home") {
                include "modules/home/" . $_GET["url"] . ".php";

            } else if ($_GET["url"] == "organitations") {
                include "modules/organitations/" . $_GET["url"] . ".php";

            } else if ($_GET["url"] == "partners") {
                include "modules/partners/" . $_GET["url"] . ".php";

            }



        } else {
            include "modules/login.php";
        }

    } else {
        include "modules/login.php";
    }



    ?>

    <script src="Views/assets/jquery.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>

    <!-- =========================Inicio DATA TABLES==============================================
    
     datatables con bootstrap -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <!-- Para usar los botones -->
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- Para los estilos en Excel     -->
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

    <!--=========================Fin DATA TABLES==============================================-->
    <?php

    if (isset($_SESSION["Ingreso"]) && $_SESSION["Ingreso"] == TRUE) {
        if (isset($_GET["url"])) {

            echo '<script src="Views/js/helpers/validaRut.js" ></script>';

            if ($_GET["url"] == "home") {

                echo '<script src="Views/js/app/home/' . $_GET["url"] . '.js" type="module"></script>';

            } else if ($_GET["url"] == "organitations") {

                echo '<script src="Views/js/app/organitations/' . $_GET["url"] . '.js" type="module"></script>';

            } else if ($_GET["url"] == "partners") {

                echo '<script src="Views/js/app/partners/' . $_GET["url"] . '.js" type="module"></script>';

            }



        }
    }
    ?>

</body>

</html>