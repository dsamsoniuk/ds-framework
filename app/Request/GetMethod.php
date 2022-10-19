<?php

namespace App\Request;

class GetMethod extends Method {

    public $method;

    public function __construct()
    {
        $this->method = $_GET;
    }



}