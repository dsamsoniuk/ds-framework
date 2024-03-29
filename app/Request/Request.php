<?php
declare(strict_types = 1);

namespace App\Request;

class Request {
    
    public $get;
    public $post;
    public $server;
    
    public function __construct()
    {
        $this->get      = GetMethod::getInstance();
        $this->post     = PostMethod::getInstance();
        $this->server   = ServerMethod::getInstance();
        // $this->get      = new Method($_GET);
        // $this->post     = new Method($_POST);
        // $this->server   = new Method($_SERVER);
    }
    
}