<?php

namespace Core\Http\Server;

use Core\Http\Message\HttpRequest;
use Core\Http\Message\HttpResponse;

interface MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse;
}
