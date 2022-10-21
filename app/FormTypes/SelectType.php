<?php

namespace App\FormTypes;


class SelectType implements TypeInterface {

    private $type = 'select';

    public function valid($value)
    {
        return is_string($value);
    }
    public function parse($value) {
        return $value;
    }
    public function getType() : string {
        return $this->type;
    }
    
    public function getMessage() : string {
        return "Nie poprawne pole wyboru";
    }
    
}