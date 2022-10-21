<?php

namespace Src\Api;

use App\Controller;
use App\Request\Request;
use Src\Repository\CustomerRepository;

class ApiUserController extends Controller {

    /** @var CustomerRepository  $customerRepository */
    private $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();

    }
    public function userData(){
        $req            = new Request();
        $customerId     =  $req->get->get('id');
        $customer       = $this->customerRepository->find($customerId);

        $this->responseJson($customer);
    }
}