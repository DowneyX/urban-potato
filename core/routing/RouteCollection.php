<?php

namespace core\routing;

use Exception;

class RouteCollection
{
    private array $routes; // [method][path] = callback
    private array $paths; // [name] = path

    public function addRoute($callback, string $path, string $method, string $name = null): void
    {
        $this->routes[$method][$path] = $callback;
        if ($name != null) {
            $this->paths[$name] = $path;
        }
    }

    public function hasRoute(string $path, string $method): bool
    {
        return !empty($this->routes[$method][$path]);
    }

    public function hasPath(string $name): bool
    {
        return !empty($this->paths[$name]);
    }

    public function getCallback(string $path, string $method): array
    {
        if ($this->hasRoute($path, $method)) {
            return $this->routes[$method][$path];
        }

        throw new Exception("route doesn't exist for:" . $path);
    }

    public function getPath(string $name): string
    {
        if ($this->hasPath($name)) {
            return $this->paths[$name];
        }
        throw new Exception("there is no path for the name: " . $name);
    }

    public function getRoutesWithParams(string $method)
    {
        $array = [];
        foreach ($this->routes[$method] as $path => $_) {
            if (preg_match('/{.*?}/', $path)) {
                $array[] = $path;
            }
        }
        return $array;
    }
}