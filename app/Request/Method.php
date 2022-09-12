<?php
declare(strict_types = 1);

namespace App\Request;

class Method {
    
    private $method;

    /**
     * @param array $method
     */
    public function __construct(array $method) {
        $this->method = $method;
    }

    public function get(string $name) : string {
        return isset($this->method[$name]) ? $this->method[$name] : '';
    }
    public function getAll(){
        return $this->method;
    }

}