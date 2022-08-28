<?php
    require_once __DIR__.'/helpers.php';
    session_start();
    spl_autoload_register(function ($class) {
        require_once(__DIR__.'/'.str_replace('\\', '/', $class) .'.php');
    });
    //This is the front controller
    $controller = $_GET['controller'] ?? 'user';
    $method = $_GET['action'] ?? 'index';
    $controllerClassName = 'App/Controllers/' . ucfirst($controller) . 'Controller';

    $controllerPath = __DIR__ . '/' .$controllerClassName . '.php';
    if (file_exists($controllerPath)) {
        $pathTransformed = str_replace('/', '\\', $controllerClassName);
        $controllerIntance = new $pathTransformed();

        if (method_exists($controllerIntance, $method)) {
            $controllerIntance->$method();
        }
        else {
            die(sprintf('Method %s does not exists on controller %s', $method, $controller));
        }
    }
    else {
        die(sprintf('Controller %s does not exist', $controller));
    }