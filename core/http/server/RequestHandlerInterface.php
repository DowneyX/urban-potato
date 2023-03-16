<?php

namespace core\http\server;

use core\HttpRequest;
use core\HttpResponse;

interface RequestHandlerInterface
{
    public function handle(HttpRequest $request): HttpResponse;
}
