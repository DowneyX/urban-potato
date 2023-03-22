<?php

namespace core\middleware;

use core\container\Container;
use core\http\message\HttpRequest;
use core\http\message\HttpResponse;
use core\http\server\MiddlewareInterface;
use core\http\server\RequestHandlerInterface;
use core\routing\RouteCollection;

class RoutingMiddleware implements MiddlewareInterface
{
    private RouteCollection $routeCollection;
    private container $container;
    public function __construct(RouteCollection $routeCollection, Container $container)
    {
        $this->routeCollection = $routeCollection;
        $this->container = $container;
    }
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        $callback = $this->routeCollection->getCallback($path, $method);

        if ($callback == null) {
            return new HttpResponse('page not found', 404);
        }

        $constroler = $this->container->get($callback[0]);

        return call_user_func([$constroler, $callback[1]], $request);
    }
}