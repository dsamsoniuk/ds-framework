<?php

namespace App\Request;

class Method {
    
    private $method;

    public function __construct(array $method) {
        $this->method = $method;
    }

    public function get($name) {
        return isset($this->method[$name]) ? $this->method[$name] : false;
    }
    public function getAll(){
        return $this->method;
    }

}