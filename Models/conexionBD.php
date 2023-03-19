<?php

class conexionBD
{

    static public function cBD()
    {
        //BASE DE DATOS DE DESARROLLO
        $dbname = "ftejidos_sistemabd";
        $user = 'ftejidos_usertjs';
        $pass = '61CIL=5e7bnG';
        $host = '162.241.61.159';


        try {
            $bd = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $bd->exec("set names utf8");
            $bd->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $bd;
        } catch (PDOException $e) {

            echo 'Fallo la conexion prueba...' . $e->getMessage();
        }
    }


}