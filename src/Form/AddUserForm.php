<?php


namespace Src\Form;

use App\CreateForm;
use App\FormTypes\NumberType;
use App\Request\Request;

class AddUserForm {

    private $name = 'add_user';
    private $actionName = '';

    public function create() : CreateForm {

        $form = new CreateForm('user.add', 'add_user');
        $form
            ->add('customer_name', new NumberType(), [
                'label' => 'Name',
                'value' => 1
            ])
            ->add('name', new NumberType(), [
                'label' => 'Name',
                'value' => 2

            ])
            ;

        return $form;
    }

}

