<?php
declare(strict_types = 1);

namespace App\Templates\Twig\Extension;

use App\Route;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions() : array
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