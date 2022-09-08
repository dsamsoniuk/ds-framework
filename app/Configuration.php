<?php

namespace App;

class Configuration {

    CONST FILE_NAME = 'config.ini';

    /**
     * @param string $name
     * 
     * @return string
     */
    public static function get($name = '') : string {
        $data = parse_ini_file(__DIR__.'/../'.self::FILE_NAME);
        return isset($data[$name]) ? $data[$name] : '';
    }
}