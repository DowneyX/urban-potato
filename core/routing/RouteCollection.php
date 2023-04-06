<?php

namespace core\routing;

use Exception;

class RouteCollection
{
    private array $routes; // [method][path] = callback
    private array $paths; // [name] = path

    /**
     * will add a route to the collection
     * @param array $callback the callback for the controller
     * @param string $path the url path for this route
     * @param string $method the method that is allowed for this route
     * @param string $name an optional name related for a specific path path
     */
    public function addRoute(array $callback, string $path, string $method, string $name = null): void
    {
        $this->routes[$method][$path] = $callback;
        if ($name != null) {
            $this->paths[$name] = $path;
        }
    }

    /**
     * check if a route exists in the collection
     * @param string $path path associated with route
     * @param string $method path associated with route
     * @return bool true if route exist in collection false otherwise
     */
    public function hasRoute(string $path, string $method): bool
    {
        return !empty($this->routes[$method][$path]);
    }

    /**
     * check if path exists in collection
     * @param string $name name associated with path
     * @return bool true if path exist in collection false otherwise
     */
    public function hasPath(string $name): bool
    {
        return !empty($this->paths[$name]);
    }

    /**
     * will return the callback array based on the given parameters
     * @param string $path path accociated with callback
     * @param string $method method accociated with method
     * @return array callback array
     */
    public function getCallback(string $path, string $method): array
    {
        if ($this->hasRoute($path, $method)) {
            return $this->routes[$method][$path];
        }

        throw new Exception("route doesn't exist for:" . $path);
    }

    /**
     * get the path with the given parameters
     * @param string $name name associated with path
     * @return string the path
     */
    public function getPath(string $name): string
    {
        if ($this->hasPath($name)) {
            return $this->paths[$name];
        }
        throw new Exception("there is no path for the name: " . $name);
    }

    /**
     * return array with all the routes with parameters
     * @param string $method get routes with this method
     */
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
