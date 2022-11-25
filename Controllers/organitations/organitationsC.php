<?php


require_once "../../Models/organitations/organitationsM.php";

class OrganitationsC
{

    function saveOrganitationsC()
    {

        $_data = json_decode($_POST["data"], true);
        $eRut = $_data["eRut"];
        $nameOrganitations = $_data["nameOrganitations"];
        $typeOrganitations = $_data["typeOrganitations"];
        $street = $_data["street"];
        $number = $_data["number"];
        $reference = $_data["reference"];
        $idRegion = $_data["idRegion"];
        $idProvincia = $_data["idProvincia"];
        $idComuna = $_data["idComuna"];

        $rut = explode('-', $eRut);
        $dv = $rut[1];
        $rutSinPuntos = explode('.', $rut[0]);
        $rutSave = $rutSinPuntos[0] . $rutSinPuntos[1] . $rutSinPuntos[2];

        /*PENDIENTE VALIDACIONES*/

        $dataSave = [
            "rutSave" => $rutSave,
            "dv" => $dv,
            "nameOrganitations" => $nameOrganitations,
            "typeOrganitations" => $typeOrganitations,
            "street" => $street,
            "number" => $number,
            "reference" => $reference,
            "idRegion" => $idRegion,
            "idProvincia" => $idProvincia,
            "idComuna" => $idComuna,
        ];


        $response = OrganitationsM::saveOrganitationsM($dataSave);


        echo json_encode($response);

    }

    function getOrganitationsC()
    {
        $response = OrganitationsM::getOrganitationsM();
        echo json_encode($response);
    }

    function getOrganitationC()
    {
        $idOrganitation = $_POST["idOrganitations"];
        $response = OrganitationsM::getOrganitationM($idOrganitation);
        echo json_encode($response);

    }

    function editOrganitationC()
    {

        $_data = json_decode($_POST["data"], true);
        $eRut = $_data["eRut"];
        $nameOrganitations = $_data["nameOrganitations"];
        $typeOrganitations = $_data["typeOrganitations"];
        $street = $_data["street"];
        $number = $_data["number"];
        $reference = $_data["reference"];
        $idRegion = $_data["idRegion"];
        $idProvincia = $_data["idProvincia"];
        $idComuna = $_data["idComuna"];
        $idAddress = $_data["idAddress"];
        $idOrganitation = $_data["idOrganitation"];

        $rut = explode('-', $eRut);
        $dv = $rut[1];
        $rutSinPuntos = explode('.', $rut[0]);
        $rutSave = $rutSinPuntos[0] . $rutSinPuntos[1] . $rutSinPuntos[2];

        /*PENDIENTE VALIDACIONES*/

        $editaData = [
            "rutSave" => $rutSave,
            "dv" => $dv,
            "nameOrganitations" => $nameOrganitations,
            "typeOrganitations" => $typeOrganitations,
            "street" => $street,
            "number" => $number,
            "reference" => $reference,
            "idRegion" => $idRegion,
            "idProvincia" => $idProvincia,
            "idComuna" => $idComuna,
            "idAddress" => $idAddress,
            "idOrganitation" => $idOrganitation
        ];


        $response = OrganitationsM::editOrganitationM($editaData);


        echo json_encode($response);

    }


}


if ($_POST["action"] == "saveOrganitations") {

    $action = new OrganitationsC;
    $action->saveOrganitationsC();

} elseif ($_POST["action"] == "getOrganitations") {

    $action = new OrganitationsC;
    $action->getOrganitationsC();

} elseif ($_POST["action"] == "getOrganitation") {

    $action = new OrganitationsC;
    $action->getOrganitationC();

} elseif ($_POST["action"] == "editOrganitation") {

    $action = new OrganitationsC;
    $action->editOrganitationC();

}