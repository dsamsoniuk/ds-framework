<?php

namespace App\Templates;

interface TemplateInterface {
    /**
     * @param string $name
     * @param array $params
     * 
     * @return [type]
     */
    public function renderView(string $name, array $params);
}