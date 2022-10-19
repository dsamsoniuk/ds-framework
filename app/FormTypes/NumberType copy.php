<?php

namespace App\FormTypes;

use Exception;

class PostCodeType implements TypeInterface {

    private $type = 'text';

    public function valid($value)
    {
        return is_int($value);
    }

    public function getType() : string {
        return $this->type;
    }
    
}