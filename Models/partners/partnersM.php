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



}

/*QUERyy*/
/*SELECT concat(p.rut_persona,'-',p.dv_persona) as rut,
concat(p.primer_nombre,' ',p.segundo_nombre,' ',p.apellido_paterno,' ',p.apellido_materno) as namePartner, 
c.correo_contacto as emailPartner,
concat(d.calle,', ', d.numero,', ',co.nombre_comuna,', ',pro.nombre_provincia,', ',r.nombre_region) as address
FROM tj_persona as p
inner join tj_contacto as c on c.id_contacto = p.id_contacto_fk
inner join tj_direccion as d on d.id = p.id_direccion_fk
inner join tj_region as r on r.id_region = d.region_fk
inner join tj_provincia as pro on pro.id_provincia = d.provincia_fk 
inner join tj_comuna as co on co.id_comuna = d.comuna_fk*/