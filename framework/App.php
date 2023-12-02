<?php

namespace Framework;

use Framework\Router;

class App
{
    public static function run()
    {
        foreach (Router::getRoutesGet() as $routeConfig) {
            $routeDispatcher = new RouteDispatcher($routeConfig);

            $routeDispatcher->process();
        }
    }
}