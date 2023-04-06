<?php

namespace core\http\handling;

use core\http\HttpRequest;
use core\http\HttpResponse;

interface RequestHandlerInterface
{
    public function handle(HttpRequest $request): HttpResponse;
}
