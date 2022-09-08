<?php

namespace App;

class Parse {

    public static function int($value){
        return intval($value);
    }

    public static function string($value){
        $value = @strip_tags($value);
        $value = @stripslashes($value);

        return $value;
    }
}