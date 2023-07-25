<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "../../Models/partners/partnersM.php";
require_once "../helpers/validationsC.php";
require_once "../../Controllers/users/usersC.php";

require_once "../../Models/users/usersM.php";

class PartnersC
{
    function getPartnersC()
    {

        $rol = $_SESSION["rol"];
        $allRecords = $rol === 'Administrador';   

        $response = PartnersM::getPartnersM($allRecords, $_SESSION["organizacion"]);
        echo json_encode(["state" => true, "data" => $response, "rol" => $rol]);

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
        $rol = isset($_data["rol"]) && $_data["rol"] !== null ? $_data["rol"] : 'socio';
        $cellPhone = $_data["cellPhone"];
        $phone = $_data["phone"];
        $mail = $_data["mail"];
        $street = $_data["street"];
        $number = $_data["number"];
        $references = $_data["references"];
        $regionId = $_data["regionId"];
        $provinceId = $_data["provinceId"];
        $communeId = $_data["communeId"];
        $organizacionId = isset($_data["organizacionId"]) && $_data["organizacionId"] !== null ? $_data["organizacionId"] : $_SESSION["organizacion"];

        $separateRut = explode('-', $rut);
        $dv = $separateRut[1];
        $rutSinPuntos = explode('.', $separateRut[0]);
        $rutSave = $rutSinPuntos[0] . $rutSinPuntos[1] . $rutSinPuntos[2];

        $dataSave = [
            "organizacionId" => $organizacionId,
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
                case "organizacionId":
                    $error = ValidationsC::validateSelection($value, "Organización");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
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

        // VALIDAR QUE EL USUARIO INGRESADO NO ESTE REGISTRADO
    
        $existe = PartnersM::validateTheExistenceOfTheUserM($dataSave['rutSave'].'-'.$dataSave['dv']);
 
        if(!empty($existe)){
            //SI EXISTE VALIDAR QUE NO ESTE REGISTRADO EN LA MISMA ORGANIZACION
            $existeEnOrganizacion = PartnersM::validateUserInTheOrganizationM($dataSave['rutSave'], $dataSave['organizacionId']);
            if(!empty($existeEnOrganizacion)){    
                echo json_encode(["state" => false, "data" => "El usuario ya esta registrado en esta organización."]);
                return ;
            }

            // VALIDAR QUE SI EXISTE DEBE SER SOCIO,
            // DEBIDO A QUE SOLO UN SOCIO PUEDE ESTAR INSCRITO EN DISTINTAS ORGANIZACIONES.
            if($existe->rol !== 'Socio'){
                echo json_encode(["state" => false, "data" => "El usuario ya esta registrado con el rol de ".$existe->rol]);
                return ;
            }

        }

        // SI POSEE ROL DE ADMINISTRADOR O COORDINADOR SE DEBE ESTABLECER LA CONTRASEÑA 
        // POR DEFECTO

        $guardarEnLogin = false;

        // se deba validar que no exista en la bd, en caso de existir se debe cambiar el estado solamente
        if( $rol === 'Administrador' || $rol === 'Coordinador'){
            $guardarEnLogin = true;
        }



      if(!empty($errors)){
          echo json_encode(["errors"=>$errors]);
          return;
      }

     $response = PartnersM::savePartnerM($dataSave, $existe, $guardarEnLogin);
     echo json_encode($response);


    }
    function updatePartnerC(){

        $_data = json_decode($_POST["data"], true);
        
        $rolActual = $_data["rolActual"];
        $recordId = $_data["recordId"];
        $rutGuardado = $_data["rutGuardado"];
        $direccionId = $_data["direccionId"];
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
        $rol = isset($_data["rol"]) && $_data["rol"] !== null ? $_data["rol"] : 'socio';
        $cellPhone = $_data["cellPhone"];
        $phone = $_data["phone"];
        $mail = $_data["mail"];
        $street = $_data["street"];
        $number = $_data["number"];
        $references = $_data["references"];
        $regionId = $_data["regionId"];
        $provinceId = $_data["provinceId"];
        $communeId = $_data["communeId"];
        $organizacionId = isset($_data["organizacionId"]) && $_data["organizacionId"] !== null ? $_data["organizacionId"] : $_SESSION["organizacion"];

        $separateRut = explode('-', $rut);
        $dv = $separateRut[1];
        $rutSinPuntos = explode('.', $separateRut[0]);
        $rutSave = $rutSinPuntos[0] . $rutSinPuntos[1] . $rutSinPuntos[2];

        $rutExistenteSeparado = explode('-', $rutGuardado)[0];

        $dataSave = [
            "direccionId" => $direccionId,
            "recordId" => $recordId,
            "organizacionId" => $organizacionId,
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
            "rutExistente" => $rutExistenteSeparado
        ];

        //VALIDACIONES
        $errors = [];
        foreach($dataSave as $key => $value){
            switch($key){
                case "organizacionId":
                    $error = ValidationsC::validateSelection($value, "Organización");
                    if($error != null){
                        $errors[] = $error;
                    }
                    break;
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
                case "regionId":
                    $error =  ValidationsC::validateSelection($value, "Región");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "provinceId":
                    $error =   ValidationsC::validateSelection($value, "Provincia");
                     if($error != null){
                        $errors[] = $error;
                    }
                    break;
                case "communeId":
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

        // Si el rut ingresado es distinto al que ya esta guardado se debe validad de que
        // nuevo rut no exista
        if($dataSave['rutSave'] !== $dataSave['rutExistente']){
            // VALIDAR QUE EL USUARIO INGRESADO NO ESTE REGISTRADO
            $existe = PartnersM::validateTheExistenceOfTheUserM($dataSave['rutSave'].'-'.$dataSave['dv']);
            if(!empty($existe)){
                echo json_encode(["state" => false, "data" => "No es posible actualizar este registro, ya existe un socio con este rut"]);
                return ;
            }
        }

        // SI POSEE ROL DE ADMINISTRADOR O COORDINADOR SE DEBE ESTABLECER LA CONTRASEÑA 
        // POR DEFECTO

        // Se debe validar que si tiene derecho a login (Admim, coordinador) y cambian el rol a 
        // Socio este debe quedar desahabilitado para loguearse.

        // Ahora bien si es socio y se cambia el rol a derecho de login (Admin, Coordinador) se debe
        // validad de que si existe previamente en la bd para no duplicar el registro y solo cambiar el estado 
        

        $guardarEnLogin = false;
        $eliminarDelLogin = false;
        $cambiarEstadoLogin = false;

        if( $rolActual === 'Administrador' || $rolActual === 'Coordinador' ||  $rol === 'Socio'){
            $guardarEnLogin = false;
        }

        if($rolActual === 'Socio' && ($rol === 'Administrador' || $rol === 'Coordinador') ){
            // VALIDAR QUE NO EXISTA EN EL LOGIN PARA NO DUPLICAR EL REGISTRO

          $respuesta =  UsersC::validateUserExistenceC($rutExistenteSeparado);
          if(!empty($respuesta)){
                   
            $cambiarEstadoLogin = $respuesta->estado === 'DESHABILITADO';
          }else{
            $guardarEnLogin = true;
          }

        }

        if( ($rolActual === 'Administrador' || $rolActual === 'Coordinador') &&  $rol === 'Socio'){
            $guardarEnLogin = false;
            $eliminarDelLogin = true;
        }


        if(!empty($errors)){
            echo json_encode(["errors"=>$errors]);
            return;
        }

        $options = ["guardarLogin"=> $guardarEnLogin, "eliminarDelLogin" => $eliminarDelLogin, "cambiarEstadoLogin" => $cambiarEstadoLogin];

        $response = PartnersM::updatePartnerM($dataSave,  $options);
         echo json_encode($response);


    }

    function deletePartnerC(){

        $partnerId = $_POST["partnerId"];
        $separateRut = explode('-', $partnerId)[0];
        $response = PartnersM::deletePartnerM($separateRut);
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

}  elseif($_POST["action"] == "updatePartner") {
    $action = new PartnersC;
    $action->updatePartnerC();
} elseif($_POST["action"] == "deletePartner") {
    $action = new PartnersC;
    $action->deletePartnerC();
} 



