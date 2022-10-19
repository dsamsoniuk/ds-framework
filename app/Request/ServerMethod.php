<?php

namespace App\Request;

class ServerMethod extends Method {
    
    public $method;

    public function __construct()
    {
        $this->method = $_SERVER;
    }



}