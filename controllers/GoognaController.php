<?php

namespace controllers;

use core\Controller;
use core\http\message\HttpRequest;
use core\http\message\HttpResponse;

class GoognaController extends Controller
{
    public function googna(HttpRequest $request): HttpResponse
    {
        return new HttpResponse('this is the googna page');
    }
}