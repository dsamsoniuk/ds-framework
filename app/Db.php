<?php
declare(strict_types = 1);

namespace App;

use FaaPz\PDO\Database;

class Db {

    /**
     * @var Database $db
     */
    private static $db;

    /**
     * @return Database
     */
    public static function getConnection() : Database {

        $dbLogin    = Configuration::get('db_login');
        $dbPass     = Configuration::get('db_pass');

        $dsn        = strtr('mysql:host=_HOST_;dbname=_NAME_;charset=utf8', [
            '_HOST_' => Configuration::get('db_host'),
            '_NAME_' => Configuration::get('db_name'),
        ]);

        if (!isset(self::$db)) {
            self::$db = new Database($dsn, $dbLogin, $dbPass);
        }

        return self::$db;
    }
}
