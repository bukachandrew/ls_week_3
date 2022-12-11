<?php

namespace Base;

class Route
{
    public $routes;

    public function addRoute($path, $сontroller, $action)
    {
        $this->routes[$path] = [
            $сontroller,
            $action
        ];
    }

    public function init()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        $path = $parts['path'];
        if (($routeItem = $this->routes[$path] ?? null) !== null) {
            $controllerName = $routeItem[0];
            $actionName = $routeItem[1];

            $controller = new $controllerName;
            //$controller->$actionName();

            $view = new View();
            $controller->setView($view);
            $content = $controller->{$actionName}();

            echo $content;
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
}