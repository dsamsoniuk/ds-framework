<?php

namespace App\Secure;

use App\Request\Request;
use App\Route;
use App\Session;

class Csrf {
    
    /**
     * @return [type]
     */
    public function generateCsrfToken(){
        $token = bin2hex(random_bytes(64));
        Session::set('csrf_token', $token);
    }

    /**
     * @return [type]
     */
    public function checkCsrfTokenIsCorrect(){
        $req    = new Request();
        $token  = $req->post->get('csrf_token') ?: '';
        
        if ($token !== Session::get('csrf_token')){
            Session::addMessage("Incorrect token", 'danger');
            Route::redirect('/');
        }
    }
    /**
     * @param array $routing
     * 
     * @return array
     */
    public function addTokenToUrl(array $routing) : array {

        $token_csrf = Session::get('csrf_token');
        foreach ($routing as &$r) {
            if (isset($r['secure']) && in_array('csrf', $r['secure'])) {
                $r['route'] .= (parse_url($r['route'], PHP_URL_QUERY) ? '&' : '?') . 'csrf_token='.$token_csrf;
            }
        }
        return $routing;
    }
    
}