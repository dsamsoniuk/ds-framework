<?php

namespace App;


class Session {
    public static function start(){
        session_start();
    }
    public static function stop(){
        session_destroy();
    }
    public static function get($name){
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }
    public static function set($name, $value){
        $_SESSION[$name] = $value;
    }
    public static function addMessage($message, $type = 'success'){
        $messages = self::get('messages') ?: [];
        $messages[] = [
            'message' => $message,
            'type' => $type,
        ];
        self::set('messages', $messages);
    }
    /**
     * Once take messages and delete them
     */
    public static function getMessages(){
        $msg = self::get('messages') ?: [];
        if (!empty($msg)) {
            self::set('messages', []);
        }
        return $msg;
    }
}