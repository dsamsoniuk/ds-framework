<?php
declare(strict_types = 1);

namespace App;

use FaaPz\PDO\Clause\Conditional;
use Src\Repository\UserRepository;

class Authorization {


    /**
     * @param string $userLogin
     * @param string $userPassword
     * 
     * @return bool
     */
    public function login(string $userLogin, string $userPassword) : bool {

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
    /**
     * @return bool
     */
    public function isLoged() : bool {
        if (empty(Session::get('user'))) {
            return false;
        }
        return true;
    }
    /**
     * @param string $userLogin
     * 
     * @return array
     */
    public function checkLogin(string $userLogin) : array {
        $login  = Parse::string($userLogin);
        $db     = Db::getConnection();
        $res    = $db->select()
            ->from('user')
            ->where(new Conditional("username", "=", $login))
            ->execute()
            ->fetch() ?: [];
        
        return $res; // [] - not exists 
    }

    public function register(string $userLogin, string $userPassword){

        // TODO : register function
        $login      = Parse::string($userLogin);
        $password   = $this->hashPassword(Parse::string($userPassword));

        $userRepo = new UserRepository();
        $userRepo->add([
            'username' => $login,
            'password' => $password,
            'status' => 1,
        ]);
        return true;
    }

    /**
     * @param string $password
     * 
     * @return string
     */
    public function hashPassword(string $password) : string {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    /**
     * @return void
     */
    public function logout() : void{
        Session::set('user', []);
    }
}