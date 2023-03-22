<?php

namespace core\middleware;

use core\http\message\HttpRequest;
use core\http\message\HttpResponse;
use core\http\server\MiddlewareInterface;
use core\http\server\RequestHandlerInterface;

class ErrorHandlingMiddleware implements MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        try {
            $response = $handler->handle($request);
        } catch (\Throwable $th) {
            return new HttpResponse(
                "oops, something went wrong: 
                <br><br><strong>EXEPTION MESSAGE:</strong> <br>" . $th->getMessage() .
                "<br><br><strong>LOCATION:</strong> <br>" . $th->getFile() . " <BR> on line: " . $th->getLine() .
                "<br><br><strong>TRACE:</strong> <br>" . $th->getTraceAsString(),
                500
            );
        }
        return $response;
    }
}