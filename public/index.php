<?php

// TODO: only for test code
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Core;
use App\Exceptions\RouteNotFoundException;
use App\Request\Request;
use App\Route;
use App\Routing;
use App\Session;

require_once('../vendor/autoload.php');

try {
    Session::start();
    $request        = new Request();
    $route          = new Routing();
    $core = new Core($route, $request);
    $core->run();
} catch (LogicException $e) {
    // TODO: save log to file instead alert
    Session::addMessage('Logic exception', 'danger');
    Route::redirectByName('error.404');
} catch (RouteNotFoundException $e) {
    Session::addMessage($e->getMessage(), 'warning');
    Route::redirectByName('error.404');
} catch (Exception $e) {
    Session::addMessage($e->getMessage(), 'warning');
    Route::redirectByName('error.404');
}
