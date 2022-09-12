<?php
declare(strict_types = 1);

namespace App;

class Configuration {

    CONST FILE_NAME = 'config.ini';

    /**
     * @param string $name
     * 
     * @return string
     */
    public static function get($name = '') : string {
        $filePath = __DIR__.'/../'.self::FILE_NAME;

        if (file_exists($filePath)) {
            $data = parse_ini_file($filePath);
            return isset($data[$name]) ? $data[$name] : '';
        }
        return '';
    }
}