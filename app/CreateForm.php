<?php


namespace App;

use App\FormTypes\TypeInterface;
use App\Request\Request;

class CreateForm {

    private $errors = [];
    private $fields = [];
    private $method = 'POST';
    private $form_name = '';
    private $route_name = '';

    public function __construct($routeName = '', $formName = '')
    {
        $this->route_name = $routeName;
        $this->form_name = $formName;
    }

    public function add($name, TypeInterface $type, $data = []) {
        $formName = $this->form_name;

        $this->fields[$name] = [
            'name' => $formName ? $formName.'['.$name.']' : $name,
            'type' => $type,
            'type_name' => $type->getType(),
            'data' => $data
        ];
        return $this;
    }

    public function isValid(){
        foreach ($this->fields as &$field) {
            $type = $field['type'];
            if ( $type instanceof TypeInterface) {
                $value = isset($field['data']['value']) ? $field['data']['value'] : '';
                if ($type->valid($value)) {
                    continue;
                } else {
                    $field['error'] = $type->getMessage();
                    return false;
                }
            } 
        }
        return true;
    }

    public function setMethod($method = 'POST') {
        $this->method = $method;
    }

    public function createView(){
        return [
            'method' => $this->method,
            'route_name' => $this->route_name,
            'fields' =>  $this->fields,
            'errors' => $this->errors
        ];
    }

    public function setDataForm($data = []){

        if (isset($data[$this->form_name])) { // post
            $data = $data[$this->form_name];
        }

        foreach ($data as $key => $value) {
            if (isset($this->fields[$key]) ) {
                $this->fields[$key]['data']['value'] = $this->fields[$key]['type']->parse($value);
            }
        }
    }

    public function getData(){
        $data = [];
        foreach ($this->fields as $key => $field) {
            $data[$key] = $field['data']['value'];
        }
        return $data;
    }
}