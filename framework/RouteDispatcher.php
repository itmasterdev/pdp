<?php

namespace Framework;

use Framework\RouteConfig;

class RouteDispatcher
{
    private RouteConfig $routeConfig;
    private array $paramMap = [];
    private array $paramRequestMap = [];
    private string $requestUri = '/';

    public function __construct(RouteConfig $routeConfig)
    {
        $this->routeConfig = $routeConfig;
    }

    public function process()
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    private function saveRequestUri()
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfig->route = $this->clean($this->routeConfig->route);
        }
    }

    private function clean(string $str): string
    {
        return preg_replace('/(^\/)(\/$)/', '', $str);
    }

    private function setParamMap()
    {
        $routeArr = explode('/', $this->routeConfig->route);

        dd($this->routeConfig->route);
        foreach ($routeArr as $paramKey => $param) {
            if(preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }


    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];

            $requestUriArray[$paramKey] = '{.*}';

        }

        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    private function prepareRegex()
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run()
    {
        if (preg_match('/'. $this->requestUri . '/', $this->routeConfig->route)) {
            $this->render();
        }
    }

    private function render()
    {
        $className = $this->routeConfig->controller;
        $actionName = $this->routeConfig->action;

        (new $className)->$actionName(...$this->paramRequestMap);
    }
}