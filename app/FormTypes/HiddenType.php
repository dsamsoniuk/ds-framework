<?php

namespace App\FormTypes;

class HiddenType implements TypeInterface {

    private $type = 'hidden';

    public function valid($value)
    {
        return true;
    }
    public function parse($value) {
        return $value;
    }
    public function getType() : string {
        return $this->type;
    }
    public function getMessage() : string {
        return "Nie poprawna wartosc";
    }
    public function addParams() : array {
        return [];
    }
}