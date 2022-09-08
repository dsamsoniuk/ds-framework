<?php

namespace App;

use FaaPz\PDO\Clause\Conditional;

class Authorization {

    public function login($userLogin, $userPassword){

        $login      = Parse::string($userLogin);
        $password   = Parse::string($userPassword);

        if (!$this->isLoged() && !empty($user = $this->checkLogin($login))) {
            if (password_verify($password, $user['password'])) {
                Session::set('user', $user);
                return true;
            }
        }
        return false;
    }
    public function isLoged(){
        if (empty(Session::get('user'))) {
            return false;
        }
        return true;
    }

    public function checkLogin($userLogin){
        $login  = Parse::string($userLogin);
        $db     = Db::getConnection();
        $res    = $db->select()
            ->from('user')
            ->where(new Conditional("username", "=", $login))
            ->execute()
            ->fetch();
        
        return $res; // [] - not exists 
    }

    public function register($userLogin, $userPassword){
        $login      = Parse::string($userLogin);
        $password   = $this->hashPassword(Parse::string($userPassword));

        // Db::
    }

    public function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function logout(){
        Session::set('user', []);
    }
}