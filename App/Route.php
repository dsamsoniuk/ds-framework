<?php

namespace App;

class Route {
    
    /**
     * @param string $url
     * 
     * @return string
     */
    public static function getUrl(string $url) : string {
        $token_csrf = Session::get('csrf_token');
        $url        .= (parse_url($url, PHP_URL_QUERY) ? '&' : '?') . 'csrf_token='.$token_csrf;
        return $url;
    }

    /**
     * @param string $name
     * 
     * @return string
     */
    public static function getByName(string $name) : string {
        $routing    = new Routing();
        $route      = $routing->getRouteByName($name);
        $url        = '/';
        if ($route) {
            $url       = $route['route'];
        }

        return $url;
    }
    /**
     * @param string $url
     * 
     * @return [type]
     */
    public static function redirect(string $url) : void {
        $url = self::getUrl($url);
        header("Location: ".$url);
        die();
    }
    /**
     * @param string $name
     * 
     * @return [type]
     */
    public static function redirectByName(string $name) : void {
        $url = self::getByName($name);
        header("Location: ".$url);
        die();
    }
}