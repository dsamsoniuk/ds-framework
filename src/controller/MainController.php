<?php

namespace Source\Controller;

use App\Core\Controller;
use FaaPz\PDO\Clause\Conditional;
use Source\Service\MainService;

class MainController extends Controller {

    /** @var MainService $service */
    private $service;

    public function __construct()
    {
        $this->service = new MainService();
    }

    public function index(){
        $rand = $this->service->getRandomNumber();
        // $res = $this->service->getSelect();
        
        $postData = $this->post;

        return $this->renderView('main.html.twig', [
            'rand_num' => $rand
        ]);
    }
}