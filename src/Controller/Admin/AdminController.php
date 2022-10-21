<?php

namespace Src\Controller\Admin;

use App\Controller;
use Src\Repository\CustomerRepository;
use Src\Service\UserService;

class AdminController extends Controller {

    /** @var CustomerRepository  $customerRepository */
    private $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
    }

    public function index(){
        UserService::requiredLogedIn();

        return $this->renderView('admin/index.html.twig', [
        ]);
    }

    public function clientList(){
        UserService::requiredLogedIn();
        $customers =  $this->customerRepository->findAll();
        
        return $this->renderView('admin/client-list.html.twig', [
            'customers' => $customers
        ]);
    }

}