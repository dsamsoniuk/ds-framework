<?php

namespace App\Templates\Twig;

use App\Templates\TemplateInterface;

class TwigTemplate implements TemplateInterface {

    public function renderView(string $name, array $params)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $twig   = new \Twig\Environment($loader);

        $twig->addExtension(new \App\Templates\Twig\Extension\AppExtension);
        $twig->addExtension(new \App\Templates\Twig\Extension\SessionExtension);

        return $twig->render($name, $params);
    }
}