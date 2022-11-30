<?php


require_once "../../Models/partners/partnersM.php";

class PartnersC
{
    function getPartnersC()
    {

        $response = PartnersM::getPartnersM();
        echo json_encode($response);

    }


}


if ($_POST["action"] == "getPartners") {

    $action = new PartnersC;
    $action->getPartnersC();

} 