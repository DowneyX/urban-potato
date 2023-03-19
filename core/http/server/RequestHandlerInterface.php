<?php

namespace core\http\server;

use core\http\message\HttpRequest;
use core\http\message\HttpResponse;

interface RequestHandlerInterface
{
    public function handle(HttpRequest $request): HttpResponse;
}
