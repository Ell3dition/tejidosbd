<?php


class ValidationsC {

    static function validateEmptyString($string, $inputName){
        if(empty($string)){
           return  ["state" => false, "data" => $inputName." es un dato obligatorio"];
        }
    }

    static function validateSelection($value, $inputName){
        if($value == 0 || $value =='0' || $value == null  ){
           return ["state" => false, "data" =>  $inputName." es un dato obligatorio"];
        }
    }
}