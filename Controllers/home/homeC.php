<?php
require_once "../../Models/home/homeM.php";

class HomeC
{

    function getDataChartC(){
        $response = HomeM::getDataChartM();
        echo json_encode($response);
    }
    function getGenresC(){
        $response = HomeM::getDataGenresM();
        echo json_encode($response);
    }
    

}

 
if ($_POST["action"] == "getDataChart") {

    $action = new HomeC;
    $action->getDataChartC();

}else if ($_POST["action"] == "getDataGenres") {

    $action = new HomeC;
    $action->getGenresC();

} 
