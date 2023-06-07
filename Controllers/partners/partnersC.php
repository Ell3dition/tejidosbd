<?php


require_once "../../Models/partners/partnersM.php";

class PartnersC
{
    function getPartnersC()
    {

        $response = PartnersM::getPartnersM();
        echo json_encode($response);

    }

    function getEducationalLevelC()
    {

        $response = PartnersM::getEducationalLevelM();
        echo json_encode($response);

    }


}


if ($_POST["action"] == "getPartners") {

    $action = new PartnersC;
    $action->getPartnersC();

}elseif($_POST["action"] == "getEducationalLevel") {

    $action = new PartnersC;
    $action->getEducationalLevelC();

} elseif($_POST["action"] == "savePartner") {

    $action = new PartnersC;
    $action->getEducationalLevelC();

} 