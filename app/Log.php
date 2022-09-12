<?php
declare(strict_types = 1);

namespace App;

class Log {

    CONST LOG_PATH = '../logs/error_php.txt';

    /**
     * @param string $error
     * 
     * @return void
     */
    public static function add(string $error) : void {
        $filePath       = __DIR__.'/'.self::LOG_PATH;
        $logFile        = fopen($filePath, "a")  or die("Unable to open file!");
        $currentDate    = date('Y-m-d H:i:s');
        fwrite($logFile, $error." :: ".$currentDate."\n");
        fclose($logFile);
    }

}