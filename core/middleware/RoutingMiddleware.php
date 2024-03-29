<?php

namespace core\middleware;

use core\container\Container;
use core\http\HttpRequest;
use core\http\HttpResponse;
use core\http\handling\RequestHandlerInterface;
use core\routing\RouteCollection;

class RoutingMiddleware implements MiddlewareInterface
{
    private RouteCollection $routeCollection;
    private Container $container;
    public function __construct(RouteCollection $routeCollection, Container $container)
    {
        $this->routeCollection = $routeCollection;
        $this->container = $container;
    }

    /**
     * will route the request to the right controller method and return the response accordingly
     * @param HttpRequest $request the request being handled
     * @param RequestHandlerInterface $handler the request handler
     * @return HttpResponse the response
     */
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $path = $request->getPath();
        $method = $request->getMethod();

        //if this route exist call the corresponding controller
        if ($this->routeCollection->hasRoute($path, $method)) {
            $callback = $this->routeCollection->getCallback($path, $method);
            $controller = $this->container->get($callback[0]);
            return call_user_func([$controller, $callback[1]], $request);
        }

        //check if route has matching parameterized route and the corresponding controller
        $route = $this->getMatchingRoute($path, $method);
        if ($route != null && $this->routeCollection->hasRoute($route, $method)) {
            $params = $this->getRouteParameters($route, $path);
            $params["request"] = $request;
            $callback = $this->routeCollection->getCallback($route, $method);
            $controller = $this->container->get($callback[0]);

            // callback parameters have to be strings for now
            return call_user_func([$controller, $callback[1]], ...$params);
        }

        // route doesn't exist.
        // should probably have a seperate NotFoundHandler but this is fine for now
        return new HttpResponse('<h1>404 page not found</h1>', 404);
    }

    /**
     * will return an accociative array of the route parameters
     * example:
     * route: user/{id}
     * path: user/1
     * array: [id = 1]
     * @param string $route the given route
     * @param string $path the given path
     * @return array the accociative array
     */
    private function getRouteParameters(string $route, string $path): array
    {
        $expPath = explode('/', $path);
        $expRouteWithParams = explode('/', $route);
        $params = [];
        foreach ($expPath as $key => $unit) {
            if (preg_match('/{.*?}/', $expRouteWithParams[$key])) {
                preg_match('/(?<=\{).*?(?=\})/', $expRouteWithParams[$key], $matches);
                $params[$matches[0]] = $unit;
            }
        }
        return $params;
    }

    /**
     * wil return a parameterized route that matches the current path and method
     * @param string $path
     * @param string $method
     * @return string|null the matching route
     */
    private function getMatchingRoute(string $path, string $method): string|null
    {
        //may god save us all

        $expPath = explode("/", trim($path, "/"));
        $routesWithParams = $this->routeCollection->getRoutesWithParams($method);

        //loop through routes with a parameters
        foreach ($routesWithParams as $routeWithParams) {
            //explode route with parameters
            $expRouteWithParams = explode("/", trim($routeWithParams, "/"));

            //check if the route and path have the same count
            if (count($expRouteWithParams) != count($expPath)) {
                continue;
            }

            // check which route fits the shoe
            foreach ($expPath as $key => $unit) {
                if ($unit != $expRouteWithParams[$key] && !preg_match('/{.*?}/', $expRouteWithParams[$key])) {
                    continue 2;
                }
            }
            // the shoe fits return the route
            return $routeWithParams;
        }
        return null;
    }
}
