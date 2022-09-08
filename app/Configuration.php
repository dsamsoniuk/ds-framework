<?php

namespace App;

class Configuration {

    CONST fileName = 'config.ini';

    public static function get($name = ''){
        $data = parse_ini_file(__DIR__.'/../'.self::fileName);
        return isset($data[$name]) ? $data[$name] : '';
    }
}