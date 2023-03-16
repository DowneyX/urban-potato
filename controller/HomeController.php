<?php

namespace controller;

use core\Controller;
use core\HttpResponse;
use core\HttpRequest;
use core\templating\TemplateEngine;
use Exception;

class HomeController extends Controller
{
    public function home(HttpRequest $request): HttpResponse
    {
        $templateEngine = new TemplateEngine();
        $test = $templateEngine->render("home",["googa" => "this is a googa variable"]);
        return new HttpResponse($test);
    }
}
