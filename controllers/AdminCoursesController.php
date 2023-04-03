<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminCoursesController extends Controller
{
    public function coursesGet(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("admin")) {
            return new HttpResponse("403 Forbidden", 403);
        }
        $courses = $this->courseMapper->fetchAll();
        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render("AdminCoursesPage", ["error" => $error, "message" => $message, "courses" => $courses]);
        return new HttpResponse($view);
    }
}