<?php

require_once "../../Models/helpers/functionsM.php";

class HelpersC
{

    function getRegionesC()
    {
        $response = HelpersM::getRegionesM();
        echo json_encode($response);
    }

    function getProvinciasC()
    {
        $idRegion = $_POST["idRegion"];
        $response = HelpersM::getProvinciasM($idRegion);
        echo json_encode($response);
    }

    function getComunasC()
    {
        $idProvincia = $_POST["idProvincia"];
        $response = HelpersM::getComunasM($idProvincia);
        echo json_encode($response);
    }

}


if ($_POST["action"] == "getRegiones") {

    $helper = new HelpersC;
    $helper->getRegionesC();

} else if ($_POST["action"] == "getProvincias") {

    $helper = new HelpersC;
    $helper->getProvinciasC();

} else if ($_POST["action"] == "getComunas") {

    $helper = new HelpersC;
    $helper->getComunasC();

}