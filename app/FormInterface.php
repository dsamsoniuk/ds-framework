<?php 

namespace App;

interface FormInterface {
    public function create($data = []) : CreateForm;
}