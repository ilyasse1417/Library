<?php

namespace Application;

class App
{
    // Router
    static function run()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        if (!$uri) {
            $uri = 'page/index';
        }

        $explode = explode('/', $uri);

        if (count($explode) < 2) {
            die('error 404 - missing data');
        }

        list($controllerName, $actionName) = $explode;

        if (strpos($actionName, "?") !== false) {
            $ex = explode('?', $actionName);
            list($actionName) = $ex;
        }

        $controller = '\Application\Controller\\' . ucfirst($controllerName) . 'Controller';
        $action = strtolower($actionName) . 'Action';


        if (!class_exists($controller)) {
            // TODO redirect to 404 page
            die('error 404 - controller not found');
        }

        if (!method_exists($controller, $action)) {
            // TODO redirect to 404 page
            die('error 404 - action not found');
        }

        $controllerObject = new  $controller();

        return $controllerObject->$action();
    }
}
