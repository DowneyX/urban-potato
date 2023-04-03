<?php

namespace core\templating;

use core\routing\RouteCollection;
use Exception;

class UrlGenerator
{
    private $routeCollection;
    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }
    public function getUrlFor(string $name, array $params = []): string
    {
        $route = $this->routeCollection->getPath($name);

        if ($this->hasParameters($route)) {
            $route = $this->generateRouteWithParams($route, $params);
        }
        return $route;
    }

    private function generateRouteWithParams(string $route, $params): string
    {
        preg_match('/{.*?}/', $route, $matches);

        if (count($params) != count($matches)) {
            throw new Exception("given parameters does not match the parameters for route: " . $route);
        }

        $newRoute = $route;
        foreach ($matches as $key => $match) {
            $pos = strpos($newRoute, $match);
            if ($pos !== false) {
                $newRoute = substr_replace($newRoute, $params[$key], $pos, strlen($match));
            }
        }
        return $newRoute;
    }

    private function hasParameters(string $route)
    {
        if (preg_match('/{.*?}/', $route)) {
            return true;
        }
        return false;
    }
}