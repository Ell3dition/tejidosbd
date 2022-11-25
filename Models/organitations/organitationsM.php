<?php

require_once "../../Models/conexionBD.php";

class OrganitationsM extends conexionBD
{


    static function saveOrganitationsM($dataSave)
    {
        $conection = conexionBD::cBD();

        try {

            $conection->beginTransaction();

            //INSERT TABLA DIRECCION

            $sqlDireccion = "INSERT INTO tj_direccion (calle, numero, referencia, region_fk, provincia_fk, comuna_fk) 
                            values (:calle, :numero, :referencia, :region, :provincia, :comuna)";

            $pdo = $conection->prepare($sqlDireccion);
            $pdo->bindParam(":calle", $dataSave['street']);
            $pdo->bindParam(":numero", $dataSave['number']);
            $pdo->bindParam(":referencia", $dataSave['reference']);
            $pdo->bindParam(":region", $dataSave['idRegion']);
            $pdo->bindParam(":provincia", $dataSave['idProvincia']);
            $pdo->bindParam(":comuna", $dataSave['idComuna']);
            $pdo->execute();
            $idDireccion = $conection->lastInsertId();

            if ($idDireccion == NULL) {
                $conection->rollBack();
                return array("state" => false, "data" => "Error al insertar la direccion");
            }

            $sqlOrganitation = "INSERT INTO tj_organizacion (erut, erut_dv, nombre, tipo_organizacion, id_direccion_fk)
            values(:erut, :dv, :nombre, :tipo, :direccion)";

            $pdo = $conection->prepare($sqlOrganitation);
            $pdo->bindParam(":erut", $dataSave['rutSave']);
            $pdo->bindParam(":dv", $dataSave['dv']);
            $pdo->bindParam(":nombre", $dataSave['nameOrganitations']);
            $pdo->bindParam(":tipo", $dataSave['typeOrganitations']);
            $pdo->bindParam(":direccion", $idDireccion);

            if ($pdo->execute()) {
                $conection->commit();
                return ["state" => true, "data" => "Registro guardado con satisfactoriamente"];

            }


            $conection->rollBack();
            return ["state" => false, "data" => "Hubo un problema al intentar guardar el registo, si el problema persiste contacte al administrador"];


        } catch (PDOException $error) {
            $conection->rollBack();
            return ["state" => false, "data" => $error->getMessage()];
        }

    }



    static function getOrganitationsM()
    {
        try {
            $sql = "SELECT * FROM get_organitations";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $listOrganitations = $pdo->fetchAll();
            $pdo = null;
            return ["state" => true, "data" => $listOrganitations];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }
    }



}