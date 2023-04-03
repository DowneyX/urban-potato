<?php

namespace core\middleware;

use core\http\HttpRequest;
use core\http\HttpResponse;
use core\http\handling\RequestHandlerInterface;

interface MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse;
}