<?php

namespace App\Templates\Twig\Extension;

use App\Route;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('getRouteByName', [$this, 'getRouteByName']),
        ];
    }

    /**
     * @param string $name
     * 
     * @return string
     */
    public function getRouteByName(string $name): string
    {
        $url = Route::getByName($name);
        return $url;
    }
}