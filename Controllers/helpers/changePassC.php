<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../../Models/helpers/changePassM.php";

class ChangePassC {

    function changePass()
    {
        $userId = $_SESSION["id"];

        $passOne= $_POST["passOne"];
        $passTwo= $_POST["passTwo"];

        $minimumPas = 6;

        if (strlen(trim($passOne)) < $minimumPas) {
            echo json_encode(array(
                'state' => false,
                'data' => 'El mínimo de la contraseña es de 6 caracteres'
            ));
            return;
        }
    
        if ($passOne !== $passTwo) {
            echo json_encode(array(
                'state' => false,
                'data' => 'Las contraseñas no coinciden'
            ));
            return;
        }
    
        $ChangePass = new ChangePassM($userId ,$passOne);
        $respuesta = $ChangePass->changePassM($userId ,$passOne);

        echo json_encode($respuesta);
    }
}

if ($_POST["action"] == "changePwd") {
    $action = new ChangePassC;
    $action->changePass();
}