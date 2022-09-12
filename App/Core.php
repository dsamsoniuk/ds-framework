<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Request\Request;
use App\Routing;
use App\Secure\Csrf;

class Core {

    /**
     * @var Routing $route
     */
    private $route;
    /**
     * @var Request $request
     */
    private $request;

    /**
     * @param Routing $route
     * @param Request $request
     */
    public function __construct(Routing $route, Request $request)
    {
        $this->route = $route;
        $this->request = $request;
    }
    /**
     * @return void
     */
    public function run() : void {

        $this->route->findController();
        $currentRoute   = $this->route->getRouteByController();
        $method         = $this->route->getMethod();
        $reqMethod      = $this->request->server->get('REQUEST_METHOD');

        if ($currentRoute && $method) {
            $c      = new $currentRoute['class']();
            
            $csrf   = new Csrf();
            if (!Session::get('csrf_token')) {
                $csrf->generateCsrfToken();
            }
            if ($reqMethod == 'POST' && isset($currentRoute['secure']) && in_array('csrf', $currentRoute['secure'])) {
                $csrf->checkCsrfTokenIsCorrect();
                $csrf->generateCsrfToken();
            }

            $html   = $c->{$method}();
            echo $html;
        } else {
            throw new RouteNotFoundException();
        }
    }
}

