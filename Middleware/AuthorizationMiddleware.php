<?php

namespace Middleware;

use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;
use Vendor\Http\Server\MiddlewareInterface;
use Vendor\Http\Server\RequestHandlerInterface;

class AuthorizationMiddleware implements MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $isAuthorized = true;
        if (!$isAuthorized) {
            $response = new HttpResponse('not authorized', 403);
            return $response;
        }
        return $handler->handle($request);
    }
}
