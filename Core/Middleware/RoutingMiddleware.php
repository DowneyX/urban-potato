<?php

namespace Core\Middleware;

use Core\Http\Server\MiddlewareInterface;
use Core\Http\Server\RequestHandlerInterface;
use Core\HttpResponse;
use Core\Routing\RouteCollection;

class RoutingMiddleware implements MiddlewareInterface
{
    private RouteCollection $routeCollection;
    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }
    public function process(\Core\HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        $callback = $this->routeCollection->getCallback($path, $method);

        if ($callback == null) {
            return new HttpResponse('page not found', 404);
        }
        return call_user_func($callback, $request);
    }
}
