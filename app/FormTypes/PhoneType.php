<?php

namespace App\FormTypes;


class PhoneType implements TypeInterface {

    private $type = 'text';

    public function addParams() : array {
        return [
            'matches' => '[0-9]{9}',
            'prefix' => '+48',
            'maxLength' => 9
        ];
    }

    public function valid($value)
    {
        $params = $this->addParams();
        // preg_match('/[0-9\-\(\)\s]+$/', $input_line, $output_array);
        return !empty(preg_match('/'.$params['matches'].'/', $value));
    }
    public function parse($value) : string {
        return $value;
    }
    public function getType() : string {
        return $this->type;
    }
    public function getMessage() : string {
        return "Nie poprawna wartosc, podaj 9 cyfr";
    }
    
}