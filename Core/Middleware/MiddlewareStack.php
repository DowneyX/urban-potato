<?php

namespace Core\Middleware;

use Core\Http\Message\HttpRequest;
use Core\Http\Message\HttpResponse;
use Core\Http\Server\MiddlewareInterface;
use Core\Http\Server\RequestHandlerInterface;

class MiddlewareStack implements RequestHandlerInterface
{
    private array $middlewares = [];
    private RequestHandlerInterface $finalResponse;

    public function __construct(RequestHandlerInterface $finalResponse)
    {
        $this->finalResponse = $finalResponse;
    }

    public function add(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(HttpRequest $request): HttpResponse
    {
        $middleware = array_pop($this -> middlewares);
        return $middleware->process($request, $this);
    }
}
