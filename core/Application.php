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

    /**
     * runs the application
     */
    public function run(): void
    {
        // get response from middleware components
        $response = $this->middlewareStack->handle($this->request);

        //send response
        $response->send();
    }

    /**
     * will add a route to the route collection
     * @param array $callback the callback for the controller
     * @param string $path the url path for this route
     * @param string $method the method that is allowed for this route
     * @param string $name an optional name related for a specific path path
     */
    public function addRoute(array $callback, string $path, string $method = 'get', string $name = null): void
    {
        $this->routeCollection->addRoute($callback, $path, $method, $name);
    }
    /**
     * will add middleware to the stack
     * @param MiddlewareInterface $middleware middleware to add to the middleware stack
     */
    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewareStack->addMiddleware($middleware);
    }
}
