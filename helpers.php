<?php
if (!function_exists('setFlashMessage')) {
    function setFlashMessage($key, $value) {
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('getFlashMessage')) {
    function getFlashMessage($key) {
        $value = $_SESSION[$key];
        $_SESSION[$key] = null;

        return $value;
    }
}

if (!function_exists('hasFlashData')) {
    function hasFlashData($key) {
        return isset($_SESSION[$key]);
    }
}

if (!function_exists('redirect')) {
    function redirect($url) {
        header('Location: ' .$url);
    }
}

if (!function_exists('makeUrl')) {
    function makeUrl($controller, $action, $params = []) {
        $url = sprintf('?controller=%s&action=%s', $controller, $action);
        //Add params now
        foreach ($params as $key => $value) {
            $url .= "&$key=$value";
        }

        return $url;
    }
}