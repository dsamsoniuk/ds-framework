<?php

namespace Src\Controller;

use App\Controller;
use App\Db;
use App\Request\Request;
use Src\Form\AddUserForm;
use Src\Repository\CustomerRepository;

class UserController extends Controller {

    /** @var CustomerRepository  $customerRepository */
    private $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();

    }
    public function add(){

        $req            = new Request();
        $customerId     = $req->get->get('customer');

        $addUserForm    = new AddUserForm();
        $form           = $addUserForm->create();

        if ($req->server->get('REQUEST_METHOD') == 'POST') {
            $form->setDataForm($req->post->getAll());
        } else if ($customerId) {
            $customer = $this->customerRepository->find($customerId);
            $form->setDataForm($customer);
        }

        if ($req->server->get('REQUEST_METHOD') == 'POST' && $form->isValid()) {
            // zapis do bazy
        }
        

        $view = $form->createView();

        return $this->renderView('user.html.twig', [
            'form' => $view,
        ]);
    }
}