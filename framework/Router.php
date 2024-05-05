<?php

namespace Framework;

class Router
{
    private static array $routesGet = [];

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    /**
     * @param string $route
     * @param array $action
     * @return RouteConfig
     */
    public static function get(string $route, array $action): RouteConfig
    {
        $routeConfig = new RouteConfig($route, $action[0], $action[1]);
        self::$routesGet[] = $routeConfig;

        return $routeConfig;
    }
}
