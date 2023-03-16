<?php

namespace controller;

use core\Controller;
use core\HttpResponse;
use core\HttpRequest;

class GoognaController extends Controller
{
    public function googna(HttpRequest $request): HttpResponse
    {
        return new HttpResponse('this is the googna page');
    }
}
