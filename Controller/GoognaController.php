<?php

namespace Controller;

use Core\Controller;
use Core\HttpResponse;
use Core\HttpRequest;

class GoognaController extends Controller
{
    public function googna(HttpRequest $request): HttpResponse
    {
        return new HttpResponse('this is the googna page');
    }
}
