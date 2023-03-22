<?php

namespace core;

use core\http\message\HttpRequest;
use core\http\server\MiddlewareInterface;
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

    public function run()
    {
        // get response from middleware components
        $response = $this->middlewareStack->handle($this->request);

        //send response
        $response->send();
    }

    public function addRoute($callback, string $path, string $name, array $methods = ['get'])
    {
        $this->routeCollection->addRoute($callback, $path, $name, $methods);
    }

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewareStack->addMiddleware($middleware);
    }
}