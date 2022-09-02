<?php

namespace App;

class Validation {

    public static function parseInt($value){
        return intval($value);
    }

    public static function parseSafeString($value){
        $value = @strip_tags($value);
        $value = @stripslashes($value);

        $invalid_characters = array("$", "%", "#", "<", ">", "|");
        $value = str_replace($invalid_characters, "", $value);
        return intval($value);
    }
}