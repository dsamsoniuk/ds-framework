<?php

namespace App;

use Exception;

// TODO: only for test code, need to be 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Core {

    private $csrfExcludeUrl = ['/', '/login'];

    public function init(){
        $route          = new Routing();
        $route->findController();
        $currentRoute   = $route->getRouteByController();
        $method         = $route->getMethod();

        if ($currentRoute && $method) {
            $c = new $currentRoute['class']();

            if (!in_array($currentRoute['route'], $this->csrfExcludeUrl)) {
                $route->checkCsrfTokenIsCorrect();
            }
            $route->generateCsrfToken();

            $html   = $c->{$method}();
            echo $html;
        } else {
            throw new Exception('Error 404 - Page not found');
        }

    }
}

try {
    Session::start();
    $core = new Core();
    $core->init();
} catch (Exception $e) {
    echo $e->getMessage();
}
