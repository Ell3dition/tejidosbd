<?php

require_once "../../Models/conexionBD.php";

class HomeM extends conexionBD
{
    static function getDataChartM(){
        try {
            $sql = "SELECT * FROM getActivePartnersOrganizations";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $data = $pdo->fetch();
            $pdo = null;
            return ["state" => true, "data" => $data];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }

    }

    static function getDataGenresM(){
        try {
            $sql = "SELECT * FROM getNumberOfGenres";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $data = $pdo->fetch();
            $pdo = null;
            return ["state" => true, "data" => $data];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }

    }
    static function getAgeRangeM(){
        try {
            $sql = "SELECT * FROM getAgeRange";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $data = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $data];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }

    }

    static function getNumberOfPeopleByOrganizationM(){
        try {
            $sql = "SELECT * FROM getNumberOfPeopleByOrganization";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $data = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $data];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }

    }
   
}