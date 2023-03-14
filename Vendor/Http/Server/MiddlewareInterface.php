<?php

namespace Vendor\Http\Server;

use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;

interface MiddlewareInterface
{
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse;
}
