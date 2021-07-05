<?php

namespace App\Core;

use App\Core\Db;

class Controller extends Db {
    public $get = [];
    public $post = [];
    public function __construct()
    {

    }
    /**
     * Undocumented function
     *
     * @param string $templateName default path
     * @param array $params
     * @return void
     */
    public function renderView($templateName, $params = []){
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $twig   = new \Twig\Environment($loader);
        return $twig->render($templateName, $params);
    }
    public function setGlobalData(){
        $this->get      = $_GET;
        $this->post     = $_POST;
        $this->server   = $_SERVER;
        $this->session   = $_SESSION;
    }
    public function setUrlData($data){
        $this->get = array_merge($this->get, $data);
    }
}