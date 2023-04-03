<?php

namespace core\middleware;

use core\http\handling\RequestHandlerInterface;
use core\http\HttpRequest;
use core\http\HttpResponse;

class ErrorHandlingMiddleware implements MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        try {
            $response = $handler->handle($request);
        } catch (\Throwable $th) {
            return new HttpResponse(
                "Internal server error: 
                <br><br><strong>EXEPTION MESSAGE:</strong> <br>" . $th->getMessage() .
                "<br><br><strong>LOCATION:</strong> <br>" . $th->getFile() . " <BR> on line: " . $th->getLine() .
                "<br><br><strong>TRACE:</strong> <br>" . $th->getTraceAsString(),
                500
            );
        }
        return $response;
    }
}