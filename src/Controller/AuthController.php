<?php

namespace Src\Controller;

use App\Authorization;
use App\Controller;
use App\Parse;
use App\Session;
use Src\Service\MainService;
use App\Request\Request;
use App\Route;

class AuthController extends Controller {

    public function login(){
        
        $req        = new Request();
        $login      = $req->post->get('login');
        $password   = $req->post->get('password');

        $auth       = new Authorization();
        if ($auth->isLoged()) {
            Route::redirectByName('main.index');
        }

        if ($login && $password) {
            $result     = $auth->login($login, $password);
            if (!$result) {
                Session::addMessage('Incorrect login or password', 'danger');
            } else {
                Route::redirectByName('main.index');
            }
        }

        return $this->renderView('login.html.twig', []);
    }

    public function register(){
        
        $req        = new Request();
        $login      = $req->post->get('login');
        $password   = $req->post->get('password');
        
        $auth       = new Authorization();
        if ($auth->isLoged()) {
            Route::redirectByName('main.index');
        }

        if ($login && $password) {
            $result     = $auth->register($login, $password);
            if (!$result) {
                Session::addMessage('Incorrect login or password', 'danger');
            } else {
                Session::addMessage('Account created', 'success');
                Route::redirectByName('main.login');
            }
        }

        return $this->renderView('register.html.twig', []);
    }
    public function logout(){
        $auth = new Authorization();
        $auth->logout();
        Session::addMessage('You have been logged out.');

        Route::redirectByName('main.index');
    }
}