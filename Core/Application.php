<?php

namespace Core;

use Core\Http\Server\MiddlewareInterface;
use Core\HttpRequest;
use Core\Middleware\MiddlewareStack;
use Core\Routing\RouteCollection;

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

    public function addRoute($callback, string $path, array $methods = ['get'])
    {
        $this->routeCollection->addRoute($callback, $path, $methods);
    }

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewareStack->addMiddleware($middleware);
    }
}
