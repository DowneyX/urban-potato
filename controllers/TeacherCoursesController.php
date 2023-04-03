<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class TeacherCoursesController extends Controller
{
    public function teacherCourses(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("teacher")) {
            return new HttpResponse("403 Forbidden", 403);
        }
        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");

        $userId = $this->sessionManager->get("id");
        $courses = $this->courseMapper->fetchAllWithExaminorId($userId);
        $data = [];
        foreach ($courses as $course) {
            $examinor = $this->userMapper->findById($course->getExaminorId());
            $data[] =
                [
                    "course" => $course,
                    "examinor" => $examinor
                ];
        }

        $view = $this->render("TeacherCoursesPage", ["error" => $error, "message" => $message, "data" => $data]);
        return new HttpResponse($view);
    }
}