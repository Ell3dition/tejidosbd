<?php

require_once 'conexionBD.php';

class LoginM extends ConexionBD
{
    static function userLoginM($usuario)
    {

        $pdo = conexionBD::cBD()->prepare("SELECT * FROM getUsersLogin WHERE usuario = :usuario");
        $pdo->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $pdo->execute();
        $user = $pdo->fetch();
        $pdo = null;
        return $user;

    }

}