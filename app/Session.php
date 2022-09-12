<?php
declare(strict_types = 1);

namespace App;

class Session {

    public static function start(){
        session_start();
    }

    public static function stop(){
        session_destroy();
    }
    /**
     * @param string $name
     * 
     * @return string
     */
    public static function get(string $name) {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }
    public static function set($name, $value){
        $_SESSION[$name] = $value;
    }
    /**
     * @param string $message
     * @param string $type
     * 
     * @return void
     */
    public static function addMessage(string $message, $type = 'success') : void {
        $messages = self::get('messages') ?: [];
        $messages[] = [
            'message' => $message,
            'type' => $type,
        ];
        self::set('messages', $messages);
    }

    /**
     * Once take messages and delete them
     * @return array
     */
    public static function getMessages() : array{
        $msg = self::get('messages') ?: [];
        if (!empty($msg)) {
            self::set('messages', []);
        }
        return $msg;
    }
}