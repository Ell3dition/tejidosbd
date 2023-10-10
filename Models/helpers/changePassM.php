<?php

require_once "../../Models/conexionBD.php";

class ChangePassM extends conexionBD
{

    function changePassM($userId, $newPass)
    {

        try {
            $passHash = password_hash($newPass, PASSWORD_DEFAULT);
            $sql = "UPDATE tj_login SET clave = :passHash WHERE id = :userId";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":passHash", $passHash, PDO::PARAM_STR);
            $pdo->bindParam(":userId", $userId, PDO::PARAM_STR);
            if($pdo->execute()){

                return ["state" => true, "data" => 'Contraseña actualizada correctamente'];

            }else{
                return ["state" => false, "data" => 'Hubo un error al actualizar la contraseña, si el problema persiste contacte al administrador'];

            }
            
        } catch (PDOException $error) {
            return ["state" => false, "data" => $error->getMessage()];
        }

    }


}