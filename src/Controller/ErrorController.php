<?php

namespace Src\Controller;

use App\Controller;

class ErrorController extends Controller {

    public function error404(){
        return $this->renderView('error404.html.twig', []);
    }
}