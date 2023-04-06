<?php

namespace core\middleware;

use core\http\HttpRequest;
use core\http\HttpResponse;
use core\http\handling\RequestHandlerInterface;
use Exception;

class MiddlewareStack implements RequestHandlerInterface
{
    private array $middlewareStack = [];

    /**
     * will add middleware to the stack
     * @param MiddlewareInterface $middleware middleware to add to the stack
     */
    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewareStack[] = $middleware;
    }

    /**
     * will walk the request through the middleware stack
     * @param HttpRequest the request being send through the stack
     * @return HttpResponse the response object
     */
    public function handle(HttpRequest $request): HttpResponse
    {
        $middleware = array_shift($this->middlewareStack);
        if ($middleware != null) {
            return $middleware->process($request, $this);
        }
        throw new Exception("middleware stack ended without response");
    }
}
