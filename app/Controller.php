<?php
declare(strict_types = 1);

namespace App;

use App\Templates\TemplateFactory;
use App\Templates\Twig\TwigTemplate;

abstract class Controller {

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
     * @param array $data
     * 
     * @return void
     */
    public function responseJson($data = []) : void {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
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