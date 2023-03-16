<?php

namespace Core\Middleware;

use Core\HttpRequest;
use Core\HttpResponse;
use Core\Http\Server\MiddlewareInterface;
use Core\Http\Server\RequestHandlerInterface;
use FFI\Exception;

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
