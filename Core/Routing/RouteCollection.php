<?php

namespace Core\Routing;

use FFI\Exception;

class RouteCollection
{
    private array $routes; // [method][path][callback]

    public function addRoute($callback, string $path, array $methods = ['get'])
    {
        foreach ($methods as $method) {
            $this->routes[$method][$path] = $callback;
        }
    }

    public function hasRoute(string $path, string $method)
    {
        return !empty($this->routes[$method][$path]);
    }

    public function getCallback(string $path, string $method)
    {
        if (!$this->hasRoute($path, $method)) {
            return null;
        }
        return $this->routes[$method][$path];
    }
}
