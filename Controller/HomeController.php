<?php

namespace Controller;

use Core\Controller;
use Core\HttpResponse;
use Core\HttpRequest;
use Core\Http\Server\RequestHandlerInterface;

class HomeController extends Controller
{
    public function home(): HttpResponse
    {
        return new HttpResponse('this is a home page');
    }
}
