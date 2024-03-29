<?php

namespace Src\Controller;

use App\Controller;
use App\Session;
use Src\Service\MainService;

class MainController extends Controller {

    /** @var MainService $service */
    private $service;

    public function __construct()
    {
        $this->service = new MainService();
    }

    public function index(){

        $rand   = $this->service->getRandomNumber();
        $user   = Session::get('user');

        return $this->renderView('main.html.twig', [
            'rand_num' => $rand,
            'user' => $user,
        ]);
    }
}