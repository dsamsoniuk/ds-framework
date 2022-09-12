<?php
declare(strict_types = 1);

namespace App;

use App\Templates\TemplateFactory;
use App\Templates\Twig\TwigTemplate;

abstract class Controller {

    protected $route;

    /**
     * @param array $route
     * 
     * @return void
     */
    public function addCurrentRoute(array $route = []) : void {
        $this->route = $route;
    }

    /**
     * @param mixed $templateName
     * @param array $params
     * 
     * @return string
     */
    public function renderView($templateName, $params = []) : string{
        return $this->renderTwigView($templateName, $params);
    }

    /**
     * @param mixed $templateName
     * @param array $params
     * 
     * @return string
     */
    public function renderTwigView($templateName, $params = []) : string {
        $tpl = new TemplateFactory(new TwigTemplate());
        return $tpl->render($templateName, $params);
    }

}