<?php

namespace App;

use App\Request\Request;
use App\Secure\Csrf;
use Exception;

class Core {

    /**
     * @return string
     */
    public function run() : string {
        $request        = new Request();
        $route          = new Routing();
        $route->findController();
        $currentRoute   = $route->getRouteByController();
        $method         = $route->getMethod();
        $reqMethod      = $request->server->get('REQUEST_METHOD');

        if ($currentRoute && $method) {
            $c      = new $currentRoute['class']();

            if ($reqMethod == 'POST' && isset($currentRoute['secure']) && in_array('csrf', $currentRoute['secure'])) {
                $csrf   = new Csrf();
                $csrf->checkCsrfTokenIsCorrect();
                $csrf->generateCsrfToken();
            }

            $html   = $c->{$method}();
            return $html;
        } else {
            throw new Exception('Error 404 - Page not found');
        }
        return '';
    }
}

