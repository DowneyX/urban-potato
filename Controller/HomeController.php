<?php

namespace Controller;

use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;

class HomeController extends Controller
{
    public function home(HttpRequest $request): HttpResponse
    {
        return new HttpResponse('this is a home page');
    }
}
