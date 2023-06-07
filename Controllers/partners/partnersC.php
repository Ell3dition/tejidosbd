<?php
require_once "../../Models/partners/partnersM.php";
require_once "../helpers/validationsC.php";

class PartnersC
{
    function getPartnersC()
    {

        $response = PartnersM::getPartnersM();
        echo json_encode($response);

    }

    function getEducationalLevelC()
    {

        $response = PartnersM::getEducationalLevelM();
        echo json_encode($response);

    }


    function savePartnerC(){

        $_data = json_decode($_POST["data"], true);
        $rut = $_data["rut"];
        $firstName = $_data["firstName"];
        $secondName = $_data["secondName"];
        $lastname = $_data["lastname"];
        $secondLastname = $_data["secondLastname"];
        $birthdate = $_data["birthdate"];
        $gender = $_data["gender"];
        $educationalLevel = $_data["educationalLevel"];
        $occupation = $_data["occupation"];
        $admissionDate = $_data["admissionDate"];
        $rol = $_data["rol"];
        $cellPhone = $_data["cellPhone"];
        $phone = $_data["phone"];
        $mail = $_data["mail"];
        $street = $_data["street"];
        $number = $_data["number"];
        $references = $_data["references"];
        $regionId = $_data["regionId"];
        $provinceId = $_data["provinceId"];
        $communeId = $_data["communeId"];


        $separateRut = explode('-', $rut);
        $dv = $separateRut[1];
        $rutSinPuntos = explode('.', $separateRut[0]);
        $rutSave = $rutSinPuntos[0] . $rutSinPuntos[1] . $rutSinPuntos[2];



        $dataSave = [
            "rutSave" => $rutSave,
            "dv" => $dv,
            "firstName" => $firstName,
            "secondName" => $secondName,
            "lastname" => $lastname,
            "secondLastname" => $secondLastname,
            "birthdate" => $birthdate,
            "gender" => $gender,
            "educationalLevel" => $educationalLevel,
            "occupation" => $occupation,
            "admissionDate" => $admissionDate,
            "rol" => $rol,
            "cellPhone" => $cellPhone,
            "phone" => $phone,
            "mail" => $mail,
            "street" => $street,
            "number" => $number,
            "references" => $references,
            "regionId" => $regionId,
            "provinceId" => $provinceId,
            "communeId" => $communeId,
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
                case "firstName":
                    $error =  ValidationsC::validateEmptyString($value, "Primer Nombre");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "lastname":
                    $error = ValidationsC::validateEmptyString($value, "Apellido Paterno");
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

                case "cellPhone":
                    $error = ValidationsC::validateEmptyString($value, "Celular");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
                
                case "mail":
                    $error = ValidationsC::validateEmptyString($value, "Correo");
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

     $response = PartnersM::savePartnerM($dataSave);
     echo json_encode($response);


    }


}


if ($_POST["action"] == "getPartners") {

    $action = new PartnersC;
    $action->getPartnersC();

}elseif($_POST["action"] == "getEducationalLevel") {

    $action = new PartnersC;
    $action->getEducationalLevelC();

} elseif($_POST["action"] == "savePartner") {

    $action = new PartnersC;
    $action->savePartnerC();

} 