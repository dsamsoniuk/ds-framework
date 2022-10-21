<?php

namespace App\FormTypes;


class CheckboxType implements TypeInterface {

    private $type = 'checkbox';

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
    public function addParams() : array {
        return [];
    }
}