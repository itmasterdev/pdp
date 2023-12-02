<?php

namespace Framework;

class Router
{
    private static array $routesGet = [];

    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    public static function get(string $route, array $action): RouteConfig
    {
        $controller = $action[0];
        $action = $action[1];
        $routeConfig = new RouteConfig($route, $controller, $action);
        self::$routesGet[] = $routeConfig;

        return $routeConfig;
    }
}