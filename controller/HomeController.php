<?php

namespace controller;

use core\Controller;
use core\http\message\HttpRequest;
use core\http\message\HttpResponse;

class HomeController extends Controller
{
    public function home(HttpRequest $request): HttpResponse
    {
        $googa = "this is a variable";

        $view = $this->render("home", ["googa" => $googa]);

        return new HttpResponse($view);
    }
}
