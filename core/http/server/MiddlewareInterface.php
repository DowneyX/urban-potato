<?php

namespace core\http\server;

use core\http\message\HttpRequest;
use core\http\message\HttpResponse;

interface MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse;
}