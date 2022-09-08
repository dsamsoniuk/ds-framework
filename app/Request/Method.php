<?php

namespace App\Request;

class Method {
    
    private $method;

    /**
     * @param array $method
     */
    public function __construct(array $method) {
        $this->method = $method;
    }

    public function get(string $name) {
        return isset($this->method[$name]) ? $this->method[$name] : false;
    }
    public function getAll(){
        return $this->method;
    }

}