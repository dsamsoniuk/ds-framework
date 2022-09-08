<?php

namespace App;

use App\Request\Request;
use Exception;
use Src\Controller\AuthController;
use Src\Controller\MainController;

class Routing {
    /**
     * POMOCNIK:
     * https://www.phpliveregex.com/#tab-preg-grep
     * Cheat Sheet
     * [abc]	A single character of: a, b or c
     * [^abc]	Any single character except: a, b, or c
     * [a-z]	Any single character in the range a-z
     * [a-zA-Z]	Any single character in the range a-z or A-Z
     * ^	Start of line
     * $	End of line
     * \A	Start of string
     * \z	End of string	
     * .	Any single character
     * \s	Any whitespace character
     * \S	Any non-whitespace character
     * \d	Any digit
     * \D	Any non-digit
     * \w	Any word character (letter, number, underscore)
     * \W	Any non-word character
     * \b	Any word boundary	
     * (...)	Capture everything enclosed
     * (a|b)	a or b
     * a?	Zero or one of a
     * a*	Zero or more of a
     * a+	One or more of a
     * a{3}	Exactly 3 of a
     * a{3,}	3 or more of a
     * a{3,6}	Between 3 and 6 of a
     *
     * @var array
     */
    private $routing = [
        [
            'name'      => 'main.index',
            'class'     => MainController::class,
            'method'    => 'index',
            'route'     => '/',
        ],[
            'name'      => 'main.articles',
            'class'     => MainController::class,
            'method'    => 'articles',
            'route'     => '/articles',
            // 'require'   => [
            //     'a' => '\d+'
            // ]
        ],[
            'name'      => 'auth.login',
            'class'     => AuthController::class,
            'method'    => 'login',
            'route'     => '/login',
        ],[
            'name'      => 'auth.logout',
            'class'     => AuthController::class,
            'method'    => 'logout',
            'route'     => '/logout',
        ]
    ];
    private $controller = false;
    /**
     * inti function
     */
    public function __construct()
    {
        $req            = new Request();
        $this->server   = $req->server->getAll();
    }
    /**
     * getUrlData function
     *
     * @return void
     */
    public function getUrlData(){
        if ($this->controller === false) {
            return [];
        }
        $routing        = $this->routing[$this->controller];
        $actual_link    = explode('?', $this->server['REQUEST_URI'])[0];
        $currentUrl     = explode('/', $actual_link); // ['test','232']
        $routeUrl       = explode('/', $routing['route']); // ['test', '{a}']
        $data           = [];
        foreach ($routeUrl as $index => $part) {
            if ($part && strpos($part, '{') !== false) {
                $valName        = str_replace('{','', $part);
                $valName        = str_replace('}','', $valName);
                $data[$valName] = $currentUrl[$index];
            }
        }
        return $data;
    }
    /**
     * Undocumented function
     *
     * @return class|boolen
     */
    public function getRouteByController(){
        return $this->controller !== false ? $this->routing[$this->controller] : false;
    }
    /**
     * Undocumented function
     *
     * @return class|boolen
     */
    public function getMethod(){
        return $this->controller !== false ? $this->routing[$this->controller]['method'] : false;
    }
    /**
     * findController function
     *
     * @return void
     */
    public function findController(){
        $routes         = [];
        $actual_link    = explode('?', $this->server['REQUEST_URI'])[0];
        foreach ($this->routing as $r) {
            // $currentRoute = explode('?', );
            if (!isset($r['require'])) { // Exception
                $routes[] = '/'.str_replace('/', '\/', $r['route']).'$/';
                continue;
            }
            foreach ($r['require'] as $index => $val) {
                $ur = str_replace('{'.$index.'}', $val, $r['route']);
                $routes[] = '/'.str_replace('/', '\/', $ur).'$/';
            }
        }
        foreach ($routes as $index => $route) {
            $res = preg_grep($route, [$actual_link]);
            if (!empty($res)){
                $this->controller = $index;
                break;
            }
        }
    }

    public function generateCsrfToken(){
        $token = bin2hex(random_bytes(64));
        Session::set('csrf_token', $token);
    }

    public function checkCsrfTokenIsCorrect(){
        $req    = new Request();
        $token  = $req->get->get('csrf_token') ?: $req->get->get('csrf_token') ?: '';
        if ($token !== Session::get('csrf_token')){
            Session::addMessage("Incorrect token", 'danger');
            Route::redirect('/');
        }
    }
    
}