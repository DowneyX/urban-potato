<?php

namespace Controller;

use Core\Controller;
use Core\HttpResponse;
use Core\HttpRequest;
use Core\Http\Server\RequestHandlerInterface;

class GoognaController extends Controller
{
    public function googna(): HttpResponse
    {
        return new HttpResponse('this is the googna page');
    }
}
