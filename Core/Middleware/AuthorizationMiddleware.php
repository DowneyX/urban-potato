<?php

namespace Core\Middleware;

use Core\Http\Message\HttpRequest;
use Core\Http\Message\HttpResponse;
use Core\Http\Server\MiddlewareInterface;
use Core\Http\Server\RequestHandlerInterface;

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
