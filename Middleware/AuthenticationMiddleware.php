<?php

namespace Middleware;

use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;
use Vendor\Http\Server\MiddlewareInterface;
use Vendor\Http\Server\RequestHandlerInterface;

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
