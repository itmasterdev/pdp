<?php

namespace Framework;

use Framework\Router;

class App
{
    /**
     * @return void
     */
    public static function run(): void
    {
        foreach (Router::getRoutesGet() as $routeConfig) {
            $routeDispatcher = new RouteDispatcher($routeConfig);
            $routeDispatcher->process();
        }
    }
}