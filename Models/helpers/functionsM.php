<?php

require_once "../../Models/conexionBD.php";

class HelpersM extends conexionBD
{

    static function getRegionesM()
    {

        try {
            $sql = "SELECT id_region as id, nombre_region as name FROM tj_region";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $listRegions = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $listRegions];
        } catch (PDOException $error) {
            return ["state" => false, "data" => $error->getMessage()];
        }

    }


    static function getProvinciasM($idRegion)
    {

        try {
            $sql = "SELECT id_provincia as id, nombre_provincia as name FROM tj_provincia
            where id_region_fk = :idRegion";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":idRegion", $idRegion, PDO::PARAM_STR);
            $pdo->execute();
            $listProvincias = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $listProvincias];
        } catch (PDOException $error) {
            return ["state" => false, "data" => $error->getMessage()];
        }

    }

    static function getComunasM($idProvincia)
    {

        try {
            $sql = "SELECT id_comuna as id, nombre_comuna as name FROM tj_comuna
            where id_provincia_fk = :idProvincia";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":idProvincia", $idProvincia, PDO::PARAM_STR);
            $pdo->execute();
            $listComunas = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $listComunas];
        } catch (PDOException $error) {
            return ["state" => false, "data" => $error->getMessage()];
        }

    }

}