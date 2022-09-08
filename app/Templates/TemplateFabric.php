<?php

namespace App\Templates;

class TemplateFabric  {
    
    /**
     * @var TemplateInterface $templateInterface
     */
    private $tpl;

    public function __construct(TemplateInterface $templateInterface)
    {
        $this->tpl = $templateInterface;
    }
    
    public function render(string $name, array $params) : string{
        return $this->tpl->renderView($name, $params);
    }
}