<?php

require_once "../../Models/conexionBD.php";

class UsersM extends conexionBD
{
    static function validateUserExistenceM($userName)
    {

        try {
            $sql = "SELECT usuario, estado FROM tj_login WHERE usuario = :userName" ;
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":userName", $userName, PDO::PARAM_INT );
            $pdo->execute();
            $user = $pdo->fetch();
            $pdo = null;
            return $user;
        } catch (PDOException $error) {
            return [];
        }
        
    }


}
