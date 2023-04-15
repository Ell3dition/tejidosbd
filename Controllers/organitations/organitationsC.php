<?php
require_once "../../Models/organitations/organitationsM.php";
require_once "../helpers/validationsC.php";

class OrganitationsC
{

    function getOrganitationTypeC(){
        $response = OrganitationsM::getOrganitationTypeM();
        echo json_encode($response);
    }

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

        $legalPersonalityNumber  = $_data["legalPersonalityNumber"];
        $boardElectionDate  = $_data["boardElectionDate"];
        $yearsValidityDirective  = $_data["yearsValidityDirective"];

        $rut = explode('-', $eRut);
        $dv = $rut[1];
        $rutSinPuntos = explode('.', $rut[0]);
        $rutSave = $rutSinPuntos[0] . $rutSinPuntos[1] . $rutSinPuntos[2];

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
            "legalPersonalityNumber" => $legalPersonalityNumber,
            "boardElectionDate" => $boardElectionDate,
            "yearsValidityDirective" => $yearsValidityDirective,
        ];

        //VALIDACIONES
        $errors = [];
        foreach($dataSave as $key => $value){
            switch($key){
                case "rutSave":
                    $error = ValidationsC::validateEmptyString($value, "Rut");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "nameOrganitations":
                    $error =  ValidationsC::validateEmptyString($value, "Nombre Organización");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "typeOrganitations":
                    $error = ValidationsC::validateSelection($value, "Tipo Organización");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "street":
                    $error = ValidationsC::validateEmptyString($value, "Calle");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "number":
                    $error =  ValidationsC::validateEmptyString($value, "Número");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "idRegion":
                    $error =  ValidationsC::validateSelection($value, "Región");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "idProvincia":
                    $error =   ValidationsC::validateSelection($value, "Provincia");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "idComuna":
                    $error = ValidationsC::validateSelection($value, "Comuna");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;

                case "legalPersonalityNumber":
                    $error = ValidationsC::validateEmptyString($value, "N° de personalidad jurídica");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                
                case "boardElectionDate":
                    $error = ValidationsC::validateEmptyString($value, "Fecha elección directiva");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "yearsValidityDirective":
                    $error = ValidationsC::validateEmptyString($value, "Años duración directiva");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
            }
        }


      if(!empty($errors)){
          echo json_encode(["errors"=>$errors]);
          return;
      }

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

        $legalPersonalityNumber  = $_data["legalPersonalityNumber"];
        $boardElectionDate  = $_data["boardElectionDate"];
        $yearsValidityDirective  = $_data["yearsValidityDirective"];

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
            "idOrganitation" => $idOrganitation,
            "legalPersonalityNumber" => $legalPersonalityNumber,
            "boardElectionDate" => $boardElectionDate,
            "yearsValidityDirective" => $yearsValidityDirective,
        ];

        $errors = [];
        foreach($editaData as $key => $value){
            switch($key){
                case "rutSave":
                    $error = ValidationsC::validateEmptyString($value, "Rut");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "nameOrganitations":
                    $error =  ValidationsC::validateEmptyString($value, "Nombre Organización");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "typeOrganitations":
                    $error = ValidationsC::validateSelection($value, "Tipo Organización");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "street":
                    $error = ValidationsC::validateEmptyString($value, "Calle");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "number":
                    $error =  ValidationsC::validateEmptyString($value, "Número");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "idRegion":
                    $error =  ValidationsC::validateSelection($value, "Región");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "idProvincia":
                    $error =   ValidationsC::validateSelection($value, "Provincia");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "idComuna":
                    $error = ValidationsC::validateSelection($value, "Comuna");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;

                case "legalPersonalityNumber":
                    $error = ValidationsC::validateEmptyString($value, "N° de personalidad jurídica");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                
                case "boardElectionDate":
                    $error = ValidationsC::validateEmptyString($value, "Fecha elección directiva");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "yearsValidityDirective":
                    $error = ValidationsC::validateEmptyString($value, "Años duración directiva");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
            }
        }


      if(!empty($errors)){
          echo json_encode(["errors"=>$errors]);
          return;
      }

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

}elseif ($_POST["action"] == "getOrganitationsType") {

    $action = new OrganitationsC;
    $action->getOrganitationTypeC();

}