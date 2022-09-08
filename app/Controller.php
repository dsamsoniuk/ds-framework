<?php

namespace App;

use App\Templates\TemplateFabric;
use App\Templates\Twig\TwigTemplate;

class Controller {

    protected $route;

    public function addCurrentRoute(array $route = []){
        $this->route = $route;
    }
    /**
     * render template
     *
     * @param string $templateName default path
     * @param array $params
     * @return void
     */
    public function renderView($templateName, $params = []){
        return $this->renderTwigView($templateName, $params);
    }

    public function renderTwigView($templateName, $params = []){
        $tpl = new TemplateFabric(new TwigTemplate());
        return $tpl->render($templateName, $params);
    }

}