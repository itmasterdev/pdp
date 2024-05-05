<?php

namespace Framework;

use Framework\RouteConfig;

class RouteDispatcher
{
    private const DEFAULT_REQUEST_STRING = '/';

    private RouteConfig $routeConfig;
    private array $paramRouteMap = [];
    private array $paramRequestMap = [];
    private string $requestUri = self::DEFAULT_REQUEST_STRING;

    public function __construct(RouteConfig $routeConfig)
    {
        $this->routeConfig = $routeConfig;
    }

    /**
     * @return void
     */
    public function process(): void
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    /**
     * @return void
     */
    private function saveRequestUri(): void
    {
        if ($_SERVER['REQUEST_URI'] !== self::DEFAULT_REQUEST_STRING) {
            $this->requestUri = self::clean($_SERVER['REQUEST_URI']);
            $this->routeConfig->route = self::clean($this->routeConfig->route);
        }
    }

    /**
     * @param string $str
     * @return string
     *
     * Remove slashes from start and end of REQUEST_URI and route to have it clean
     */
    private static function clean(string $str): string
    {
        return preg_replace('/(^\/+|\/+$)/', '', $str);
    }

    /**
     * @return void
     *
     * Parse route params and add to array with dynamic route params
     */
    private function setParamMap(): void
    {
        $routeArr = explode('/', $this->routeConfig->route);

        foreach ($routeArr as $paramKey => $param) {
            // check if there are symbols { and }
            if(preg_match('/{.*}/', $param)) {
                // remove symbols { and }
                $this->paramRouteMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }
    }

    /**
     * @return void
     */
    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramRouteMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }

            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];

            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    /**
     * @return void
     */
    private function prepareRegex(): void
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    /**
     * @return void
     */
    private function run(): void
    {
        if (preg_match('/'. $this->requestUri . '/', $this->routeConfig->route)) {
            $this->render();
        }
    }

    /**
     * @return void
     */
    private function render(): void
    {
        $className = $this->routeConfig->controller;
        $actionName = $this->routeConfig->action;

        print((new $className)->$actionName(...$this->paramRequestMap));

        die();
    }
}