<?php

namespace App;

use App\Db;
use App\Twig\Extension\AppExtension;
use App\Validation;

class Controller {

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

        $twig->addExtension(new \App\Twig\Extension\AppExtension);
        $twig->addExtension(new \App\Twig\Extension\SessionExtension);

        return $twig->render($templateName, $params);
    }

    public function redirect($url){
        header("Location: ".$url);
        die();
    }
}