<?php

namespace core\middleware;

use core\HttpRequest;
use core\HttpResponse;
use core\http\server\MiddlewareInterface;
use core\http\server\RequestHandlerInterface;
use Exception;

class MiddlewareStack implements RequestHandlerInterface
{
    private array $middlewareStack = [];
    private RequestHandlerInterface $finalHandler;

    public function setFinalHandler(RequestHandlerInterface $finalHandler)
    {
        $this->finalHandler = $finalHandler;
    }

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
