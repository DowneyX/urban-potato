<?php

namespace Core\Http\Server;

use Core\HttpRequest;
use Core\HttpResponse;

interface MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse;
}
