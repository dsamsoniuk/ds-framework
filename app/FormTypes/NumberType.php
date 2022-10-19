<?php

namespace App\FormTypes;

use Exception;

class NumberType implements TypeInterface {

    private $type = 'number';

    public function valid($value)
    {
        return is_int($value);
    }

    public function getType() : string {
        return $this->type;
    }
    public function getMessage() : string {
        return "Nie poprawna wartosc";
    }
    
}