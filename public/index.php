<?php

// TODO: only for test code
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../vendor/autoload.php');

use App\Core;
use App\Route;
use App\Session;

try {
    Session::start();
    $core = new Core();
    echo $core->run();
} catch (LogicException $e) {
    // TODO: save log to file instead message
    Session::addMessage('Logic exception', 'danger');
    Route::redirectByName('error.404');

} catch (Exception $e) {
    Session::addMessage($e->getMessage(), 'warning');
    Route::redirectByName('error.404');
}