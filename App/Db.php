<?php


namespace App;

use FaaPz\PDO\Database;

class Db {
    /**
     * @return Database
     */
    public static function getConnection() : Database{

        $dbLogin    = Configuration::get('db_login');
        $dbPass     = Configuration::get('db_pass');
        $dsn        = strtr('mysql:host=_HOST_;dbname=_NAME_;charset=utf8', [
            '_HOST_' => Configuration::get('db_host'),
            '_NAME_' => Configuration::get('db_name'),
        ]);
        
        return new Database($dsn, $dbLogin, $dbPass);
    }
}
