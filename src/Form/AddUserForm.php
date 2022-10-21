<?php


namespace Src\Form;

use App\CreateForm;
use App\FormInterface;
use App\FormTypes\CheckboxType;
use App\FormTypes\HiddenType;
use App\FormTypes\NumberType;
use App\FormTypes\PhoneType;
use App\FormTypes\SelectType;
use App\FormTypes\SubmitType;
use App\FormTypes\TextType;
use App\Route;

class AddUserForm implements FormInterface {

    // private $name = 'add_user';
    // private $actionName = '';

    public function create($data = []) : CreateForm {

        $type = isset($data['type']) && $data['type']
            ? $data['type'] :( empty($data['customer'])
            ? 'client' : $data['customer']['type']) ;

        $form = new CreateForm('user.add');

        $form
            ->add('id', new HiddenType())
            ->add('type', new CheckboxType(), [
                'label' => 'Status prawny',
                'class' => 'd-flex choice-one-checkbox',
                'choices' => [
                    'client' => 'Klient indywidualny',
                    'company' => 'Firma',
                ],
                'choiceAttr' => [
                    'company' => ['class' => 'reload', 'data-redirect-with-param' => 'type=company'],
                    'client' => ['class' => 'reload', 'data-redirect-with-param' => 'type=client'],
                ],
                'value' => $type
            ]);

        if ($type == 'client') {
            $form->add('customer_name', new TextType(), [
                'label' => 'Imię i nazwisko',
                'class' => 'form-control',
                'required' => 'required'
            ]);
        } else if ($type == 'company'){
            $form->add('company_name', new TextType(), [
                'label' => 'Firma',
                'class' => 'form-control',
                'required' => 'required'
            ]);
        }

        $form
            ->add('street', new TextType(), [
                'label' => 'Ulica',
                'class' => 'form-control',
            ])
            ->add('house_nr', new NumberType(), [
                'label' => 'Numer mieszkania',
                'class' => 'form-control',
            ])
            ->add('city', new TextType(), [
                'label' => 'Miasto',
                'class' => 'form-control',
            ])
            ->add('post_code', new TextType(), [
                'label' => 'Kod pocztowy',
                'class' => 'form-control',
            ])
            ->add('province', new SelectType(), [
                'label' => 'Województwo',
                'data-url' => 'http://api.dro.nazwa.pl/.',
                'class' => 'form-control external-select'
            ])
            ->add('phone_nr', new PhoneType(), [
                'label' => 'Telefon',
                'class' => 'form-control',
            ])
            ->add('email', new TextType(), [
                'label' => 'Email',
                'class' => 'form-control',
            ])
            ;
          
            if ($type == 'client') {
                $form->add('pesel', new TextType(), [
                    'label' => 'PESEL',
                    'class' => 'form-control',
                    'required' => 'required',
                    'matches' => '[0-9]{11}',
                    'maxlength' => 11
                ]);
            } else if ($type == 'company'){
                $form->add('nip', new TextType(), [
                    'label' => 'NIP',
                    'class' => 'form-control',
                    'required' => 'required',
                    'matches' => '[0-9]{11}',
                    'maxlength' => 11
                ]);
            }

        // $form
        // ->add('submit', new SubmitType(), [
        //     'label' => '',
        //     'class' => 'btn btn-success mt-2',
        //     'value' => empty($data['customer']) ? 'Add new client' : 'Edit client' 
        // ]);
        return $form;
    }

}

