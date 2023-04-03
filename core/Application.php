<?php

namespace core;

use core\http\HttpRequest;
use core\middleware\MiddlewareInterface;
use core\middleware\MiddlewareStack;
use core\routing\RouteCollection;

class Application
{
    private RouteCollection $routeCollection;
    private HttpRequest $request;
    private MiddlewareStack $middlewareStack;

    public function __construct(
        HttpRequest $request,
        RouteCollection $routeCollection,
        MiddlewareStack $middlewareStack
    ) {
        $this->request = $request;
        $this->middlewareStack = $middlewareStack;
        $this->routeCollection = $routeCollection;
    }

    public function run(): void
    {
        // get response from middleware components
        $response = $this->middlewareStack->handle($this->request);

        //send response
        $response->send();
    }

    public function addRoute(array $callback, string $path, string $method = 'get', string $name = null): void
    {
        $this->routeCollection->addRoute($callback, $path, $method, $name);
    }

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewareStack->addMiddleware($middleware);
    }
}