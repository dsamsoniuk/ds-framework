<?php


namespace Src\Form;

use App\CreateForm;
use App\FormInterface;
use App\FormTypes\HiddenType;
use App\FormTypes\NumberType;
use App\FormTypes\SelectType;
use App\FormTypes\SubmitType;
use App\FormTypes\TextType;

class AddUserForm implements FormInterface {

    private $name = 'add_user';
    private $actionName = '';

    public function create($data = []) : CreateForm {

        $form = new CreateForm('user.add', 'add_user');
        $form
            ->add('id', new HiddenType())

            ->add('phone_nr', new NumberType(), [
                'label' => 'phone_nr',
                'class' => 'form-control'
            ])
            ->add('customer_name', new TextType(), [
                'label' => 'customer_name',
                'value' => 2,
                'class' => 'form-control'
            ])
            ->add('province', new SelectType(), [
                'label' => 'province',
                'url' => 'http://api.dro.nazwa.pl/.',
                'class' => 'form-control external-select'
            ])
            ->add('submit', new SubmitType(), [
                'label' => '',
                'class' => 'btn btn-success mt-2',
                'value' => isset($data['id']) && $data['id'] ? 'Edit client' : 'Add new client'
            ]);

        return $form;
    }

}

