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


    static function getOrganitationM($idOrganitation)
    {
        try {
            $sql = "SELECT o.id as idOrganizacion, concat(o.erut, '-', o.erut_dv) as rut, o.nombre , o.tipo_organizacion as type, 
                   d.id as idAddress,  d.calle, d.numero, d.referencia, d.region_fk, d.provincia_fk, d.comuna_fk  FROM tj_organizacion as o 
                   inner join tj_direccion as d on d.id = o.id_direccion_fk
                   where o.id = :idOrganizacion";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":idOrganizacion", $idOrganitation, PDO::PARAM_STR);
            $pdo->execute();
            $listOrganitations = $pdo->fetch();
            $pdo = null;
            return ["state" => true, "data" => $listOrganitations];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }
    }



    static function editOrganitationM($editaData){

        $conection = conexionBD::cBD();

        try {

            $conection->beginTransaction();

         

            $sqlDireccion = "UPDATE tj_direccion SET calle = :calle, 
                            numero = :numero,
                            referencia = :referencia,
                            region_fk = :region,
                            provincia_fk = :provincia,
                            comuna_fk = :comuna
                            WHERE id = :idAddress";

            $pdo = $conection->prepare($sqlDireccion);
            $pdo->bindParam(":calle", $editaData['street']);
            $pdo->bindParam(":numero", $editaData['number']);
            $pdo->bindParam(":referencia", $editaData['reference']);
            $pdo->bindParam(":region", $editaData['idRegion']);
            $pdo->bindParam(":provincia", $editaData['idProvincia']);
            $pdo->bindParam(":comuna", $editaData['idComuna']);
            $pdo->bindParam(":idAddress", $editaData['idAddress']);
            $pdo->execute();
         

            $sqlOrganitation = "UPDATE tj_organizacion SET erut = :erut,
                                erut_dv = :dv,
                                nombre = :nombre,
                                tipo_organizacion = :tipo
                                WHERE id = :idOrganitation";

            $pdo = $conection->prepare($sqlOrganitation);
            $pdo->bindParam(":erut", $editaData['rutSave']);
            $pdo->bindParam(":dv", $editaData['dv']);
            $pdo->bindParam(":nombre", $editaData['nameOrganitations']);
            $pdo->bindParam(":tipo", $editaData['typeOrganitations']);
            $pdo->bindParam(":idOrganitation", $editaData['idOrganitation']);

            $pdo->execute();
                    
            $conection->commit();
            return ["state" => true, "data" => "Registro actualizado satisfactoriamente"];

        } catch (PDOException $error) {
            $conection->rollBack();
            return ["state" => false, "data" => $error->getMessage()];
        }


    }



}