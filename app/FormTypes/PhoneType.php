<?php

namespace App\FormTypes;


class PhoneType implements TypeInterface {

    private $type = 'text';

    public function addParams() : array {
        return [
            'matches' => '[0-9]{9}',
            'prefix' => '+48',
            'maxLength' => 9,
            'minLength' => 0
        ];
    }

    public function valid($value)
    {
        $params = $this->addParams();
        if ($value) {
            return !empty(preg_match('/'.$params['matches'].'/', $value));
        }
        return true;
    }
    public function parse($value) : string {
        return $value;
    }
    public function getType() : string {
        return $this->type;
    }
    public function getMessage() : string {
        return "Nie poprawna wartość, podaj 9 cyfr";
    }
    
}