<?php


namespace proyecto\core\helpers;


class FlashMessage
{
    public static function get($key, $default = '')
    {
        if (isset($_SESSION['flash-message'])) {
            $value = $_SESSION['flash-message'][$key] ?? $default;
            unset($_SESSION['flash-message'][$key]);
        } else {
            $value = $default;
        }
        return $value;
    }

    public static function set ($key, $value){
        $_SESSION['flash-message'][$key] = $value;
    }

    public static function unset ($key){
        if (isset($_SESSION['flash-message'])){
            unset($_SESSION['flash-message'][$key]);
        }
    }
}