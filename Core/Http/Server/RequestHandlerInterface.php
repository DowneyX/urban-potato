<?php

namespace Core\Http\Server;

use Core\HttpRequest;
use Core\HttpResponse;

interface RequestHandlerInterface
{
    public function handle(HttpRequest $request): HttpResponse;
}
