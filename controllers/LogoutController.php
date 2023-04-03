<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class LogoutController extends Controller
{
    public function logout(HttpRequest $request): HttpResponse
    {
        $this->sessionManager->clearSesssion();
        return $this->getRedirect("login", ["message" => "logout-succes"]);
    }
}