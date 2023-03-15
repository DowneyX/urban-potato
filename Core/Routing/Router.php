<?php

namespace Core\Routing;

use Core\HttpRequest;
use Core\HttpResponse;

class Router
{
    private array $routes; // [method][path][callback]

    public function addRoute($callback, string $route, array $methods = ['get'])
    {
        foreach ($methods as $method) {
            $this->routes[$method][$route] = $callback;
        }
    }

    public function resolve(HttpRequest $request): HttpResponse
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return new HttpResponse('page Not found', 404);
            exit;
        }

        return call_user_func($callback);
    }
}
