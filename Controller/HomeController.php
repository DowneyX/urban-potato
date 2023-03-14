<?php

namespace Controller;

use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;
use Vendor\Http\Server\RequestHandlerInterface;

class HomeController implements RequestHandlerInterface
{
    public function handle(HttpRequest $request): HttpResponse
    {
        $response = new HttpResponse('logged in');
        return $response;
    }
}
