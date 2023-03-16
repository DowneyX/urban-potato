<?php

namespace core\http\server;

use core\HttpRequest;
use core\HttpResponse;

interface MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse;
}
