<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class HomeController extends Controller
{
    public function homeGet(HttpRequest $request): HttpResponse
    {
        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render(
            "HomePage",
            ["error" => $error,
            "message" => $message]
        );
        return new HttpResponse($view);
    }
}
