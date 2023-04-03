<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminEnrollmentsController extends Controller
{
    public function enrollmentsGet(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("admin")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        $enrollments = $this->courseEnrollmentMapper->fetchAll();
        $data = [];
        foreach ($enrollments as $value) {
            $array[] =
                [
                    "enrollment" => $value,
                    "student" => $this->userMapper->findById($value->getStudentId()),
                    "course" => $this->courseMapper->findById($value->getCourseId())
                ];
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render("AdminOverviewUsersPage", ["error" => $error, "message" => $message, "data" => $data]);
        return new HttpResponse($view);
    }
}