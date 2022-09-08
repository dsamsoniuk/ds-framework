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
     * @param string $url
     * 
     * @return [type]
     */
    public static function redirect($url = ''){
        $url = self::getUrl($url);
        header("Location: ".$url);
        die();
    }
}