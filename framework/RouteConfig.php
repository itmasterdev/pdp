<?php

namespace Framework;

class RouteConfig
{
    public string $route;
    public string $controller;
    public string $action;

    public function __construct($route, $controller, $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }
}