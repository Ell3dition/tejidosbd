<?php
if (!isset($_SESSION)) {
    session_start();
}

include "../Models/loginM.php";

class LoginC
{

    function userLoginC()
    {

        //validar reCaptcha
        $keySecret = '6Lf-9F4dAAAAAOdT9sjKTajtQZc1Lroc7TRqla78';
        $response = $_POST["g-recaptcha-response"];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $keySecret . '&response=' . $response . '';

        $validacion = curl_init($url);
        curl_setopt($validacion, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($validacion, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($validacion);
        $response = json_decode($response);
        curl_close($validacion);

        if (!$response->success) {
            $error = array("Estado" => false, "Motivo" => "reCaptcha no superado, intente nuevamente");
            echo json_encode($error);
            return;
        }

        //validar usuario
        $usuario = $_POST["usuario-Ing"];
        $contrasena = $_POST["clave-Ing"];

        $respuesta = LoginM::userLoginM($usuario);

        if (empty($respuesta)) {
            $error = array("Estado" => false, "Motivo" => "Usuario no existe");
            echo json_encode($error);
            return;
        }


        if (!password_verify($contrasena, $respuesta->clave) && $respuesta->usuario != $usuario) {

            $error = array("Estado" => false, "Motivo" => "Usuario o contraseña incorrecta");
            echo json_encode($error);
            return;

        }

        if ($respuesta->estado != 'HABILITADO') {
            $error = array("Estado" => false, "Motivo" => "Usuario deshabilitado, contácte al administrador");
            echo json_encode($error);
            return;
        }

        $_SESSION["Ingreso"] = TRUE;
        $_SESSION["usuario"] = $respuesta->usuario;
        $_SESSION["id"] = $respuesta->id;
        $_SESSION["rol"] = $respuesta->rol;
        $_SESSION["nombreUsuario"] = $respuesta->userName;
        $_SESSION["organizacion"] = $respuesta->organizacion;
        $_SESSION["nombreOrganizacion"] = $respuesta->nombreOrganizacion;
        // $_SESSION["img"] = $respuesta->IMG_USUARIO;

        echo json_encode(array("Estado" => true, "Motivo"=>$respuesta->rol));
        return;

    }
}

if ($_POST['accion'] == 'ingresar') {

    $ingreso = new LoginC();
    $ingreso->userLoginC();
}