<?php
declare(strict_types = 1);

namespace App\Templates\Twig\Extension;

use App\Session;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SessionExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('getSession', [$this, 'getSession']),
            new TwigFunction('getSessionMessages', [$this, 'getSessionMessages']),
        ];
    }

    public function getSession(string $name)
    {
        return Session::get($name);
    }
    public function getSessionMessages()
    {
        return Session::getMessages();
    }
}