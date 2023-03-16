<?php

namespace Core\Middleware;

use Core\HttpRequest;
use Core\HttpResponse;
use Core\Http\Server\MiddlewareInterface;
use Core\Http\Server\RequestHandlerInterface;

class ErrorHandlingMiddleware implements MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        try {
            $response = $handler->handle($request);
        } catch (\Throwable $th) {
            return new HttpResponse("oops, something went wrong \n" . $th->getMessage(), 500);
        }
        return $response;
    }
}
