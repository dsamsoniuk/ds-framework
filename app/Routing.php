<?php

namespace App;

use App\Request\Request;
use App\Secure\Csrf;
use Exception;
use Src\Controller\ArticleController;
use Src\Controller\AuthController;
use Src\Controller\ErrorController;
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
            'name'      => 'article.index',
            'class'     => ArticleController::class,
            'method'    => 'index',
            'route'     => '/articles',
            // 'route'     => '/articles/{a}',
            // 'require'   => [
            //     'a' => '\d+'
            // ]
        ],[
            'name'      => 'auth.login',
            'class'     => AuthController::class,
            'method'    => 'login',
            'route'     => '/login',
            'secure'    => ['csrf']
        ],[
            'name'      => 'auth.logout',
            'class'     => AuthController::class,
            'method'    => 'logout',
            'route'     => '/logout',
        ],[
            'name'      => 'error.404',
            'class'     => ErrorController::class,
            'method'    => 'error404',
            'route'     => '/error404',
        ]
    ];

    private $controller = false;
    /**
     * inti function
     */
    public function __construct()
    {
        $req            = new Request();
        $csrf           = new Csrf();

        $this->server   = $req->server->getAll();
        $this->routing  = $csrf->addTokenToUrl($this->routing);
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
     * @param string $name
     * 
     * @return array|bool
     */
    public function getRouteByName(string $name){
        foreach ($this->routing as $r) {
            if ($r['name'] === $name) {
                return $r;
            }
        }
        return false;
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
        $currentLink    = explode('?', $this->server['REQUEST_URI'])[0];
        // Preparing regex for all routes
        foreach ($this->routing as $r) {

            if (!isset($r['require'])) {
                $routes[] = '/'.str_replace('/', '\/', explode('?', $r['route'])[0]).'$/';
                continue;
            }
            // replace values with regex substitute (example: 123 with d+)
            foreach ($r['require'] as $index => $val) {
                $ur = str_replace('{'.$index.'}', $val, explode('?', $r['route'])[0]);
                $routes[] = '/'.str_replace('/', '\/', $ur).'$/';
            }
        }
        // Find by regex list current link (example: "/\/articles\/\d+$/")
        foreach ($routes as $index => $route) {
            $res = preg_grep($route, [$currentLink]);
            if (!empty($res)){
                $this->controller = $index;
                break;
            }
        }
    }


    
}