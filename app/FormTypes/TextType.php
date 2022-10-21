<?php

namespace App\FormTypes;


class TextType implements TypeInterface {

    private $type = 'text';

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
        return "Nie poprawne pole";
    }
    public function addParams() : array {
        return [];
    }
}