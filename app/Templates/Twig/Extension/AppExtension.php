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
            new TwigFunction('routeUrl', [$this, 'getRouteUrl']),
        ];
    }

    public function getRouteUrl(string $url): string
    {
        $url = Route::getUrl($url);
        return $url;
    }
}