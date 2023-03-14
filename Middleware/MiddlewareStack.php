<?php

namespace Middleware;

use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;
use Vendor\Http\Server\MiddlewareInterface;
use Vendor\Http\Server\RequestHandlerInterface;

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

        if (empty($this -> middlewares)) {
            return $this->finalResponse->handle($request);
        }
        $middleware = array_pop($this -> middlewares);

        return $middleware->process($request, $this);
    }
}
