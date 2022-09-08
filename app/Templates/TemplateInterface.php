<?php

namespace App\Templates;

interface TemplateInterface {
    public function renderView(string $name, array $params);
}