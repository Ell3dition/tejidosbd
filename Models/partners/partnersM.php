<?php

require_once "../../Models/conexionBD.php";
require_once "../../Controllers/helpers/getPassDefault.php";

class PartnersM extends conexionBD
{
    static function getPartnersM($allRecords, $organizacionId)
    {
        $sql = $allRecords 
                ? "SELECT * FROM getPartners"
                : "SELECT * FROM getPartners WHERE organizacion = $organizacionId";

        try {
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->execute();
            $listPartners = $pdo->fetchAll();
            $pdo = null;
            return $listPartners;
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

    static function savePartnerM($dataSave, $existe, $guardarEnLogin){

        $conection = conexionBD::cBD();

        try {

            $conection->beginTransaction();

            if(empty($existe)){
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
                if (!$pdo->execute()) {
                    $conection->rollBack();
                    return ["state" => false, "data" => "Error al guardar el registro"];
                
                }
            }

            // GUARDAR USUARIO EN ORGANIZACION
            $sqlOrganizacion = "INSERT INTO tj_persona_organizacion_paso (rut, organizacion) VALUES (:rut, :organizacion)";
            $pdo = $conection->prepare($sqlOrganizacion);
            $pdo->bindParam(":rut", $dataSave['rutSave'], PDO::PARAM_INT);
            $pdo->bindParam(":organizacion", $dataSave['organizacionId'], PDO::PARAM_STR );
       
            if (!$pdo->execute()) {
                $conection->rollBack();
                return ["state" => false, "data" => "Hubo un problema al intentar guardar el registo, si el problema persiste contacte al administrador"];
            }

            if($guardarEnLogin){
                
                $Pass = new GetPassDefautl();
                $defaultPass = $Pass->getPassDefautl();

                $pass = password_hash( $defaultPass, PASSWORD_DEFAULT);
                $estado = "HABILITADO";
                $sqlInsertLogin = "INSERT INTO tj_login (usuario, clave, estado) VALUES (:usuario, :clave, :estado)";
                $pdo = $conection->prepare($sqlInsertLogin);
                $pdo->bindParam(":usuario", $dataSave['rutSave'], PDO::PARAM_INT);
                $pdo->bindParam(":clave", $pass, PDO::PARAM_STR);
                $pdo->bindParam(":estado", $estado, PDO::PARAM_STR);
                if (!$pdo->execute()) {
                    $conection->rollBack();
                    return ["state" => false, "data" => "Hubo un problema al intentar guardar el registo, si el problema persiste contacte al administrador"];
                }
            }

            $conection->commit();
            return ["state" => true, "data" => "Registro guardado satisfactoriamente"];

        } catch (PDOException $error) {
            $conection->rollBack();
            return ["state" => false, "data" => $error->getMessage()];
        }

    }

    static function validateTheExistenceOfTheUserM($rut){

        try {
            $sql = "SELECT * FROM getPartners where rut = :rut ";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":rut", $rut, PDO::PARAM_STR );
            $pdo->execute();
            $listPartners = $pdo->fetch();
            $pdo = null;
            return $listPartners;
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }

    }

    static function validateUserInTheOrganizationM($rut, $organizacionId){
        try {
            $sql = "SELECT o.nombre FROM tj_persona_organizacion_paso as pop
            INNER JOIN tj_organizacion as o on o.id = pop.organizacion
            where rut = :rut and organizacion = :organizacionId";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":rut", $rut, PDO::PARAM_STR);
            $pdo->bindParam(":organizacionId", $organizacionId, PDO::PARAM_INT);
            $pdo->execute();
            $listPartners = $pdo->fetchAll();
            $pdo = null;
            return $listPartners;
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al consultar los datos si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }


    }


    static function updatePartnerM($dataSave,  $options){
        
        $conection = conexionBD::cBD();

        try {

            $conection->beginTransaction();
            
            //ACTUALIZAR DIRECCION

            $sqlDireccion = "UPDATE tj_direccion SET calle = :calle, 
                                    numero = :numero,
                                    referencia = :referencia,
                                    region_fk = :region,
                                    provincia_fk = :provincia,
                                    comuna_fk = :comuna
                            WHERE id = :direccionId";
           
            $pdo = $conection->prepare($sqlDireccion);
            
            $pdo->bindParam(":direccionId", $dataSave['direccionId'], PDO::PARAM_STR );
            $pdo->bindParam(":calle", $dataSave['street'], PDO::PARAM_STR );
            $pdo->bindParam(":numero", $dataSave['number'], PDO::PARAM_STR );
            $pdo->bindParam(":referencia", $dataSave['references'], PDO::PARAM_STR );
            $pdo->bindParam(":region", $dataSave['regionId'], PDO::PARAM_INT );
            $pdo->bindParam(":provincia", $dataSave['provinceId'], PDO::PARAM_INT );
            $pdo->bindParam(":comuna", $dataSave['communeId'], PDO::PARAM_INT );
           
           
            if ( !$pdo->execute()) {
                 $conection->rollBack();
                 return array("state" => false, "data" => "Error al actualizar la dirección");
             }

            $sqlSavePartner = "UPDATE tj_persona SET rut_persona = :rut,
                                      dv_persona = :dv, 
                                      primer_nombre = :primerNombre,
                                      segundo_nombre = :segundoNombre,
                                      apellido_paterno = :apellidoPaterno,
                                      apellido_materno = :apellidoMaterno,
                                      fecha_nacimiento = :fechaNacimiento,
                                      ocupacion_persona = :ocupacionPersona,
                                      fecha_ingreso = :fechaIngreso,
                                      rol_persona = :rolPersona, 
                                      genero_persona = :generoPersona,
                                      celular = :celular,
                                      telefono = :telefono,
                                      correo = :correo,
                                      id_estudios_fk = :idEstudio
                               WHERE rut_persona = :rutExistente";
            
            $pdo = $conection->prepare($sqlSavePartner);
           
            $pdo->bindParam(":rutExistente", $dataSave['rutExistente'], PDO::PARAM_INT);
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
            if (!$pdo->execute()) {
                $conection->rollBack();
                return ["state" => false, "data" => "Error al actualizar el registro"];
            
            }
            
            // ACTUALIZAR ORGANIZACION DE USUARIO
            $sqlOrganizacion = "UPDATE tj_persona_organizacion_paso 
                                SET rut = :rut, organizacion = :organizacion 
                                WHERE id = :recordId";
            $pdo = $conection->prepare($sqlOrganizacion);
            $pdo->bindParam(":recordId", $dataSave['recordId'], PDO::PARAM_INT);
            $pdo->bindParam(":rut", $dataSave['rutSave'], PDO::PARAM_INT);
            $pdo->bindParam(":organizacion", $dataSave['organizacionId'], PDO::PARAM_STR );
       
            if (!$pdo->execute()) {
                $conection->rollBack();
                return ["state" => false, "data" => "Hubo un problema al intentar actualizar el registo, si el problema persiste contacte al administrador"];
            }

            if( $options["guardarLogin"] ){
                $Pass = new GetPassDefautl();
                $defaultPass = $Pass->getPassDefautl();
                
                $pass = password_hash($defaultPass, PASSWORD_DEFAULT);
                $estado = "HABILITADO";
                $sqlInsertLogin = "INSERT INTO tj_login (usuario, clave, estado) VALUES (:usuario, :clave, :estado)";
                $pdo = $conection->prepare($sqlInsertLogin);
                $pdo->bindParam(":usuario", $dataSave['rutSave'], PDO::PARAM_INT);
                $pdo->bindParam(":clave", $pass, PDO::PARAM_STR);
                $pdo->bindParam(":estado", $estado, PDO::PARAM_STR);
                if (!$pdo->execute()) {
                    $conection->rollBack();
                    return ["state" => false, "data" => "Hubo un problema al intentar guardar el registo, si el problema persiste contacte al administrador"];
                }
            }

            if( $options["eliminarDelLogin"] ){
                $estado= 'DESHABILITADO';
                $sqlDisabledUser = "UPDATE tj_login SET estado = :estado WHERE usuario = :usuario";
                $pdo = $conection->prepare($sqlDisabledUser);
                $pdo->bindParam(":usuario", $dataSave['rutSave'], PDO::PARAM_INT);
                $pdo->bindParam(":estado", $estado, PDO::PARAM_STR);
                if (!$pdo->execute()) {
                    $conection->rollBack();
                    return ["state" => false, "data" => "Hubo un problema al intentar guardar el registo, si el problema persiste contacte al administrador"];
                }
            }

            if( $options["cambiarEstadoLogin"] ){
                $estado= 'HABILITADO';
                $sqlDisabledUser = "UPDATE tj_login SET estado = :estado WHERE usuario = :usuario";
                $pdo = $conection->prepare($sqlDisabledUser);
                $pdo->bindParam(":usuario", $dataSave['rutSave'], PDO::PARAM_INT);
                $pdo->bindParam(":estado", $estado, PDO::PARAM_STR);
                if (!$pdo->execute()) {
                    $conection->rollBack();
                    return ["state" => false, "data" => "Hubo un problema al intentar guardar el registo, si el problema persiste contacte al administrador"];
                }
            }
            $conection->commit();
            return ["state" => true, "data" => "Registro actualizado satisfactoriamente"];

        } catch (PDOException $error) {
            $conection->rollBack();
            return ["state" => false, "data" => $error->getMessage()];
        }

    }

    static function deletePartnerM($partnerId)
    {
        $newState = 'Inactivo';
        try {
            $sql = "UPDATE tj_persona SET estado_persona = :estado WHERE rut_persona = :id";
            $pdo = conexionBD::cBD()->prepare($sql);
            $pdo->bindParam(":estado", $newState , PDO::PARAM_STR);
            $pdo->bindParam(":id", $partnerId, PDO::PARAM_INT);
            if($pdo->execute()){
                $pdo = null;
                return ["state" => true, "data" => "Registro eliminada satisfactoriamente"];
            }

            return ["state" => false, "data" => 'Error, al eliminar registro por favor reporte al soporte'];
        } catch (PDOException $error) {
            return ["state" => false, "data" => "Hubo un error al procesar la solicitud si el problema persiste contacte al administrador \ncodigo de error :" . $error->getMessage()];
        }
    }

}
