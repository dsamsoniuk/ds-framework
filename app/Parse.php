<?php
declare(strict_types = 1);

namespace App;

class Parse {

    /**
     * @param mixed $value
     * 
     * @return int
     */
    public static function int($value) : int{
        return intval($value);
    }

    /**
     * @param mixed $value
     * 
     * @return string
     */
    public static function string($value) : string{
        $value = @strip_tags($value);
        $value = @stripslashes($value);

        return $value;
    }
}