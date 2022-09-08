<?php

namespace App;

use Exception;

// TODO: only for test code, need to be 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Core {

    private $csrfExcludeUrl = ['/'];

    /**
     * @return string
     */
    public function init() : string {
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
            return $html;
        } else {
            throw new Exception('Error 404 - Page not found');
        }
        return '';
    }
}

try {
    Session::start();
    $core = new Core();
    echo $core->init();
} catch (Exception $e) {
    echo $e->getMessage();
}
