<?php

namespace Vendor\Http\Server;

use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;

interface RequestHandlerInterface
{
    public function handle(HttpRequest $request): HttpResponse;
}
