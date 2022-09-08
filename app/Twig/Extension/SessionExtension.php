<?php

namespace App\Twig\Extension;

use App\Session;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SessionExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('session', [$this, 'getSession']),
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