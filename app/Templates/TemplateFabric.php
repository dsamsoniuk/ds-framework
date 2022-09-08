<?php

namespace App\Templates;

class TemplateFabric {
    
    /**
     * @var TemplateInterface $templateInterface
     */
    private $tpl;

    /**
     * @param TemplateInterface $templateInterface
     */
    public function __construct(TemplateInterface $templateInterface)
    {
        $this->tpl = $templateInterface;
    }
    
    /**
     * @param string $name
     * @param array $params
     * 
     * @return string
     */
    public function render(string $name, array $params) : string{
        return $this->tpl->renderView($name, $params);
    }
}