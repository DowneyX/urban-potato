<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class StudentOverviewController extends Controller
{
    public function studentOverview(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("student")) {
            return new HttpResponse("403 Forbidden", 403);
        }
        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");

        $studentId = $this->sessionManager->get("id");
        $enrollments = $this->courseEnrollmentMapper->fetchAllWithStudentId($studentId);
        $data = [];
        foreach ($enrollments as $enrollment) {
            $student = $this->userMapper->findById($enrollment->getStudentId());
            $course = $this->courseMapper->findById($enrollment->getCourseId());
            $examinor = $this->userMapper->findById($course->getExaminorId());
            $data[] =
                [
                    "enrollment" => $enrollment,
                    "student" => $student,
                    "course" => $course,
                    "examinor" => $examinor
                ];
        }

        $view = $this->render("StudentOverviewPage", ["error" => $error, "message" => $message, "data" => $data]);
        return new HttpResponse($view);
    }
}