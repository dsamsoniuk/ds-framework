<?php

namespace App\Templates;


class TwigTemplate implements TemplateInterface {

    public function renderView(string $name, array $params)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $twig   = new \Twig\Environment($loader);

        $twig->addExtension(new \App\Twig\Extension\AppExtension);
        $twig->addExtension(new \App\Twig\Extension\SessionExtension);

        return $twig->render($name, $params);
    }
}