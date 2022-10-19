<?php

// TODO: only for test code

use App\Configuration;
use App\Core;
use App\Exceptions\RouteNotFoundException;
use App\Log;
use App\Request\Request;
use App\Route;
use App\Session;
use Src\Controller\ArticleController;
use Src\Controller\AuthController;
use Src\Controller\ErrorController;
use Src\Controller\MainController;
use Src\Controller\UserController;

require_once('../vendor/autoload.php');


// if (Configuration::get('debug') == "1") {
//     ini_set('display_errors', 1);
//     ini_set('display_startup_errors', 1);
//     error_reporting(E_ALL);
// }

try {
    Session::start();
    $request        = new Request();
    $route          = Route::getInstance();

    $route->add(['name' => 'main.index', 'class' => MainController::class,'method' => 'index','route' => '/',]);
    $route->add(['name'=> 'article.index','class' => ArticleController::class, 'method'=> 'index', 'route'=> '/articles']);
    $route->add([ 'name' => 'auth.login', 'class' => AuthController::class, 'method'=> 'login', 'route' => '/login', 
    'secure'    => ['csrf']
    ]);
    $route->add(['name'=> 'auth.logout','class' => AuthController::class,'method' => 'logout','route'=> '/logout']);
    $route->add(['name'=> 'error.404','class' => ErrorController::class,'method' => 'error404','route' => '/error404']);

    $route->add(['name'=> 'user.add','class' => UserController::class, 'method'=> 'add', 'route'=> '/user/add']);
    $route->add(['name'=> 'user.add','class' => UserController::class, 'method'=> 'add', 'route'=> '/user/{customer}', 
        'require' => [
            'customer' => '\d+'
        ]
    ]);

    $core           = new Core($route, $request);
    $core->run();

} catch (RouteNotFoundException $e) {
    Session::addMessage($e->getMessage(), 'warning');
    Route::redirectByName('error.404');
} catch (LogicException $e) {
    Log::add($e->getMessage());
    Route::redirectByName('error.404');
} catch (Exception $e) {
    Session::addMessage($e->getMessage(), 'warning');
    Route::redirectByName('error.404');
} catch (Throwable $e) {
    Log::add($e->getMessage());
    Session::addMessage("Something gose wrong.", 'warning');
    Route::redirectByName('error.404');
 }
