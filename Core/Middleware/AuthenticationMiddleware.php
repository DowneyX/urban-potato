<?php

namespace Core\Middleware;

use Core\Http\Message\HttpRequest;
use Core\Http\Message\HttpResponse;
use Core\Http\Server\MiddlewareInterface;
use Core\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $isLoggedIn = false;
        if (!$isLoggedIn) {
            $response = new HttpResponse('not logged in', 401);
            return $response;
        }
        return $handler->handle($request);
    }
}
