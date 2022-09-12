<?php

namespace App;

use App\Request\Request;
use App\Secure\Csrf;


class Routing {
   
    private $routing = [];

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
     * @param array $route
     * 
     * @return void
     */
    public function add(array $route) : void {
        $this->routing[] = $route;
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