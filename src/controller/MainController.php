<?php

namespace Src\Controller;

use App\Controller;
use FaaPz\PDO\Clause\Conditional;
use Src\Service\MainService;
use App\Validation;

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
        
        $getData = $this->get;
        $val = Validation::parseInt($this->get);
        $postData = $this->post;

        return $this->renderView('main.html.twig', [
            'rand_num' => $rand
        ]);
    }
}