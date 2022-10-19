<?php
declare(strict_types = 1);

namespace App\Request;

abstract class Method {
    
    // private static $instance = null;
    
    // /**
    //  * @param array $method
    //  */
    // public function __construct(array $method) {
    //     $this->method = $method;
    // }

    public static function getInstance()
    {
        static $instances = array();

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass])){
            $instances[$calledClass] = new $calledClass();
        }
        return $instances[$calledClass];
    }

    public function get(string $name) : string {
        return isset($this->method[$name]) ? $this->method[$name] : '';
    }
    public function set(string $name, $value) {
        $this->method[$name] = $value;
    }

    public function getAll(){
        return $this->method;
    }

}