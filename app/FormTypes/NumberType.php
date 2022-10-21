<?php

namespace App\FormTypes;


class NumberType implements TypeInterface {

    private $type = 'number';

    public function valid($value)
    {
        return is_int($value);
    }
    public function parse($value) : int {
        return intval($value);
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