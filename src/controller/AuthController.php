<?php

namespace Src\Controller;

use App\Authorization;
use App\Controller;
use App\Parse;
use App\Session;
use Src\Service\MainService;
use App\Request\Request;

class AuthController extends Controller {

    // /** @var MainService $service */
    // private $service;

    public function __construct()
    {
        // $this->service = new MainService();
    }

    public function login(){
        
        $req        = new Request();
        $login      = $req->post->get('login');
        $password   = $req->post->get('password');

        $auth       = new Authorization();
        if ($auth->isLoged()) {
            $this->redirect('/');
        }

        if ($login && $password) {
            $result     = $auth->login($login, $password);
            if (!$result) {
                Session::addMessage('Wrong login or password', 'danger');
            } else {
                $this->redirect('/');

            }
        }

        return $this->renderView('login.html.twig', [
      
        ]);

    }
    public function logout(){
        $auth = new Authorization();
        $auth->logout();
        Session::addMessage('You have been logged out.');

        $this->redirect('/');
    }
}