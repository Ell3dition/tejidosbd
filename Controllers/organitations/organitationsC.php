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


}


if ($_POST["action"] == "saveOrganitations") {

    $action = new OrganitationsC;
    $action->saveOrganitationsC();

} 