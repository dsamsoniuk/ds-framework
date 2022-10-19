<?php

namespace App\Request;

class PostMethod extends Method {
    
    public $method;

    public function __construct()
    {
        $this->method = $_POST;
    }



}