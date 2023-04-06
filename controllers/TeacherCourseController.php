<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class TeacherCourseController extends Controller
{
    public function teacherCourse(HttpRequest $request, string $courseId): HttpResponse
    {
        if (!$this->sessionManager->hasRole("teacher")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($courseId) || $this->courseMapper->findById($courseId) == null) {
            return $this->getRedirect("teacherCourses", ["error" => "Invalid-Course"]);
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");

        $data = [];
        $enrollments = $this->courseEnrollmentMapper->fetchAllWithCourseId($courseId);
        $course = $this->courseMapper->findById($courseId);
        foreach ($enrollments as $enrollment) {
            $student = $this->userMapper->findById($enrollment->getStudentId());
            $examinor = $this->userMapper->findById($course->getExaminorId());
            $data[] =
                [
                    "enrollment" => $enrollment,
                    "student" => $student,
                    "course" => $course,
                    "examinor" => $examinor
                ];
        }

        $view = $this->render(
            "TeacherCoursePage",
            ["error" => $error,
            "message" => $message,
            "data" => $data,
            "course" => $course]
        );
        return new HttpResponse($view);
    }

    public function teacherCoursePost(HttpRequest $request, string $courseId): HttpResponse
    {
        if (!$this->sessionManager->hasRole("teacher")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($courseId) || $this->courseMapper->findById($courseId) == null) {
            return $this->getRedirect(
                "teacherCourses",
                ["error" => "Invalid-Course"]
            );
        }

        $formData = $request->getParamsPost();
        $grade = $formData["grade"];
        $enrollmentId = $formData["enrollmentId"];

        if (!is_numeric($grade) || (float) $grade < 0 || (float) $grade > 10) {
            return $this->getRedirect(
                "teacherCourses",
                ["error" => "Invalid-grade"]
            );
        }

        if (!is_numeric($enrollmentId)) {
            return $this->getRedirect(
                "teacherCourses",
                ["error" => "Invalid-enrollment"]
            );
        }

        $enrollment = $this->courseEnrollmentMapper->findById($enrollmentId);

        if ($enrollment == null) {
            return $this->getRedirect(
                "teacherCourses",
                ["error" => "Invalid-enrollment"]
            );
        }

        $enrollment->setGrade($grade);

        $this->courseEnrollmentMapper->update($enrollment);
        return $this->getRedirect(
            "teacherCourse",
            ["message" => "grade-succesfully-assigned"],
            [$courseId]
        );
    }
}
