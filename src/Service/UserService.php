<?php

namespace Src\Service;

use App\Authorization;
use App\Service;
use App\Route;

class UserService extends Service {
    
    public static function requiredLogedIn(){
       $auth = new Authorization();
       if (!$auth->isLoged()) {
            Route::redirectByName('auth.login');
        }
    }
}