<?php

namespace Src\Controller;

use App\Controller;
use App\Db;
use App\Request\Request;
use App\Route;
use App\Session;
use Src\Form\AddUserForm;
use Src\Repository\CustomerRepository;
use Src\Service\UserService;

class UserController extends Controller {

    /** @var CustomerRepository  $customerRepository */
    private $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();

    }
    public function view(){
        $req            = new Request();
        $customerId     =  $req->get->get('id');
        $customer       = $this->customerRepository->find($customerId);

        return $this->renderView('customer.html.twig', [
            'customer' => $customer,
        ]);
    }
    public function add(){
        UserService::requiredLogedIn();
        $req            = new Request();

        $customer       = [];
        $customerId     = intval($req->get->get('customer') ?: 0);
        $customerType   = $req->get->get('type');
        $customer       = $this->customerRepository->find($customerId);

        $addUserForm    = new AddUserForm();
        $form           = $addUserForm->create([
            'customer'  => $customer,
            'type'      => $customerType
        ]);

        if ($req->server->get('REQUEST_METHOD') == 'POST') {
            $form->setDataForm($req->post->getAll());
        } else if ($customer) {
            if ($customerType) {
                $customer['type'] = $customerType;
            }
            $form->setDataForm($customer);
        }

        if ($req->server->get('REQUEST_METHOD') == 'POST' && $form->isValid()) {

            $data = $form->getData();
            if (isset($data['id']) && $data['id'] != "") {
                $this->customerRepository->update($data);
                Session::addMessage('Data client updated', 'success');
                Route::redirectByName('admin.client.list');
            } else {
                $this->customerRepository->add($data);
                Session::addMessage('Client added', 'success');
                Route::redirectByName('admin.client.list');
            }
        }
        
        $view = $form->createView();

        return $this->renderView('admin/user.html.twig', [
            'form' => $view,
            'isCompany' => isset($customer['nip']) && $customer['nip']
        ]);
    }

    public function delete(){
        UserService::requiredLogedIn();

        $req            = new Request();
        $customerId     = intval($req->get->get('id'));

        $this->customerRepository->delete($customerId);

        Session::addMessage('Client deleted', 'success');
        Route::redirectByName('admin.client.list');

    }
}