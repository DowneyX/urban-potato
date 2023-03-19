<?php

namespace core\middleware;

use core\http\message\HttpRequest;
use core\http\message\HttpResponse;
use core\http\server\MiddlewareInterface;
use core\http\server\RequestHandlerInterface;
use Exception;

class MiddlewareStack implements RequestHandlerInterface
{
    private array $middlewareStack = [];

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewareStack[] = $middleware;
    }

    public function handle(HttpRequest $request): HttpResponse
    {
        $middleware = array_shift($this->middlewareStack);
        if ($middleware != null) {
            return $middleware->process($request, $this);
        }
        throw new Exception("middleware stack ended without response");
    }
}
