<?php

namespace core\routing;

use Exception;

class RouteCollection
{
    private array $routes; // [method][path] = callback
    private array $paths; // [name] = path

    public function addRoute($callback, string $path, string $name, array $methods = ['get'])
    {
        foreach ($methods as $method) {
            $this->routes[$method][$path] = $callback;
        }
        $this -> paths[$name] = $path;
    }

    public function hasRoute(string $path, string $method): bool
    {
        return !empty($this->routes[$method][$path]);
    }

    public function hasPath(string $name): bool
    {
        return !empty($this->paths[$name]);
    }

    public function getCallback(string $path, string $method)
    {
        if (!$this->hasRoute($path, $method)) {
            return null;
        }
        return $this->routes[$method][$path];
    }

    public function getPath(string $name): string
    {
        if ($this->hasPath($name)) {
            return $this->paths[$name];
        }
        throw new Exception("path doensn't exist in route collection for name: " . $name);
    }
}
