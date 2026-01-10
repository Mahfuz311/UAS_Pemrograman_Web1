<?php
session_start();

spl_autoload_register(function ($class_name) {
    if (file_exists('../app/config/' . $class_name . '.php')) {
        require_once '../app/config/' . $class_name . '.php';
    } else if (file_exists('../app/controllers/' . $class_name . '.php')) {
        require_once '../app/controllers/' . $class_name . '.php';
    } else if (file_exists('../app/models/' . $class_name . '.php')) {
        require_once '../app/models/' . $class_name . '.php';
    }
});

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'product/index';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';

if (file_exists('../app/controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], array_slice($url, 2));
    } else {
        echo "Method not found";
    }
} else {
    echo "Controller not found";
}