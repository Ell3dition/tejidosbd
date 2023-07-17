<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "../../Models/users/usersM.php";

class UsersC
{
    static function validateUserExistenceC($userName)
    {
        $response = UsersM::validateUserExistenceM($userName);
        return $response;
    }
}


// if ($_POST["action"] == "getPartners") {

//     $action = new PartnersC;
//     $action->getPartnersC();

// }

