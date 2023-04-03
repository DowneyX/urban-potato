<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class TestController extends Controller
{
    public function test(HttpRequest $request, string $id): HttpResponse
    {

        //if logged in return to home
        return new HttpResponse($id);

    }
}