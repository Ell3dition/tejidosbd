<?php

require_once "../../Models/conexionBD.php";

class PartnersM extends conexionBD
{



    static function getPartnersM()
    {
        try {
            $sql = "SELECT * FROM getPartners";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $listPartners = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $listPartners];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }
    }

    static function getEducationalLevelM()
    {

        try {
                  $sql = "SELECT id_estudios as id, nivel_estudios as name FROM tj_estudios";
                  $pdo = conexionBD::cBD()->prepare($sql);
                  $pdo->execute();
                  $listData = $pdo->fetchAll();
                  $pdo = null;
                  return ["state" => true, "data" => $listData];
        } catch (PDOException $error) {
                  return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }
          

    }


}
