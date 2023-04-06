<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminEnrollmentsController extends Controller
{
    public function adminEnrollments(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole("admin")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-student-id"]
            );
        }

        $enrollments = $this->courseEnrollmentMapper->fetchAllWithStudentId($id);
        $data = [];
        foreach ($enrollments as $enrollment) {
            $course = $this->courseMapper->findById($enrollment->getCourseId());
            $student = $this->userMapper->findById($enrollment->getStudentId());
            $examinor = $this->userMapper->findById($course->getExaminorId());
            $data[] =
                [
                    "enrollment" => $enrollment,
                    "examinor" => $examinor,
                    "student" => $student,
                    "course" => $course
                ];
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render(
            "AdminEnrollmentsPage",
            ["error" => $error,
            "message" => $message,
            "data" => $data,
            "studentId" => $id]
        );
        return new HttpResponse($view);
    }
}
