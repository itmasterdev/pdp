<?php

namespace Framework;

class RouteConfig
{
    public string $route;
    public string $controller;
    public string $action;
    public string $name;

    public function __construct($route, $controller, $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}