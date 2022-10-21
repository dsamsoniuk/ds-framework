<?php

namespace App\FormTypes;


class TextType implements TypeInterface {

    private $type = 'text';

    public function valid($value)
    {
        $params = $this->addParams();
        if (isset($params['matches'])) {
            return !empty(preg_match('/'.$params['matches'].'/', $value));
        }
        // preg_match('/[0-9\-\(\)\s]+$/', $input_line, $output_array);
        return is_string($value);
    }
    public function parse($value) {
        return $value;
    }
    public function getType() : string {
        return $this->type;
    }
    
    public function getMessage() : string {
        return "Nie poprawna wartość";
    }
    public function addParams() : array {
        return [];
    }
}