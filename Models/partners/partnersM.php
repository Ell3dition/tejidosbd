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

    static function savePartnerM($dataSave){


        $conection = conexionBD::cBD();

        try {

            $conection->beginTransaction();

            //INSERT TABLA DIRECCION

            $sqlDireccion = "INSERT INTO tj_direccion (calle, numero, referencia, region_fk, provincia_fk, comuna_fk) 
                            values (:calle, :numero, :referencia, :region, :provincia, :comuna)";

            $pdo = $conection->prepare($sqlDireccion);
            $pdo->bindParam(":calle", $dataSave['street'], PDO::PARAM_STR );
            $pdo->bindParam(":numero", $dataSave['number'], PDO::PARAM_STR );
            $pdo->bindParam(":referencia", $dataSave['references'], PDO::PARAM_STR );
            $pdo->bindParam(":region", $dataSave['regionId'], PDO::PARAM_INT );
            $pdo->bindParam(":provincia", $dataSave['provinceId'], PDO::PARAM_INT );
            $pdo->bindParam(":comuna", $dataSave['communeId'], PDO::PARAM_INT );
            $pdo->execute();
            $idDireccion = $conection->lastInsertId();

            if ($idDireccion == NULL) {
                $conection->rollBack();
                return array("state" => false, "data" => "Error al insertar la direccion");
            }

            $sqlSavePartner = "INSERT INTO tj_persona (rut_persona, dv_persona, primer_nombre, segundo_nombre, apellido_paterno,
            apellido_materno,  fecha_nacimiento, ocupacion_persona, fecha_ingreso, rol_persona, 
            genero_persona, celular, telefono, correo, id_estudios_fk, id_direccion_fk)
            values(:rut, :dv, :primerNombre, :segundoNombre, :apellidoPaterno, :apellidoMaterno, :fechaNacimiento, :ocupacionPersona,
            :fechaIngreso, :rolPersona, :generoPersona, :celular, :telefono, :correo, :idEstudio, :idDireccion)";

            $pdo = $conection->prepare($sqlSavePartner);
            $pdo->bindParam(":rut", $dataSave['rutSave'], PDO::PARAM_INT);
            $pdo->bindParam(":dv", $dataSave['dv'], PDO::PARAM_STR );
            $pdo->bindParam(":primerNombre", $dataSave['firstName'], PDO::PARAM_STR );
            $pdo->bindParam(":segundoNombre", $dataSave['secondName'], PDO::PARAM_STR );
            $pdo->bindParam(":apellidoPaterno", $dataSave['lastname'], PDO::PARAM_STR );
            $pdo->bindParam(":apellidoMaterno", $dataSave['secondLastname'], PDO::PARAM_STR );
            $pdo->bindParam(":fechaNacimiento", $dataSave['birthdate'], PDO::PARAM_STR );
            $pdo->bindParam(":ocupacionPersona", $dataSave['occupation'], PDO::PARAM_STR );
            $pdo->bindParam(":fechaIngreso", $dataSave['admissionDate'], PDO::PARAM_STR );
            $pdo->bindParam(":rolPersona", $dataSave['rol'], PDO::PARAM_STR );
            $pdo->bindParam(":generoPersona", $dataSave['gender'], PDO::PARAM_STR );
            $pdo->bindParam(":celular", $dataSave['cellPhone'], PDO::PARAM_STR );
            $pdo->bindParam(":telefono", $dataSave['phone'], PDO::PARAM_STR );
            $pdo->bindParam(":correo", $dataSave['mail'], PDO::PARAM_STR );
            $pdo->bindParam(":idEstudio", $dataSave['educationalLevel'], PDO::PARAM_STR );
            $pdo->bindParam(":idDireccion", $idDireccion, PDO::PARAM_INT );
          

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

}
