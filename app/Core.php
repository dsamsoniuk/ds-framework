<?php

namespace App\Core;

$route = new Routing();
$route->findController();
$controller = $route->getController();
$method = $route->getMethod();
$urlData = $route->getUrlData();

if ($controller && $method) {
    $c = new $controller();
    $c->setGlobalData();
    $c->setUrlData($urlData);
    $html = $c->{$method}();
    echo $html;
} else {
    echo '<h1> Error 404 - Page not found</h1>';
}
