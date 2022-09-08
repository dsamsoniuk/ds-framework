<?php

namespace App;

use Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Core {

    public function init(){
        $route      = new Routing();
        $route->findController();
        $controller = $route->getController();
        $method     = $route->getMethod();

        if ($controller && $method) {
            $c      = new $controller();
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
