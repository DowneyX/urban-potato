<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;
use orm\entities\CourseEnrollment;

class StudentEnrollController extends Controller
{
    public function enroll(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("student")) {
            return new HttpResponse("403 Forbidden", 403);
        }
        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");

        $courses = $this->courseMapper->fetchAll();
        $data = [];
        foreach ($courses as $course) {
            $examinor = $this->userMapper->findById($course->getExaminorId());
            $data[] =
                [
                    "course" => $course,
                    "examinor" => $examinor
                ];
        }

        $view = $this->render("StudentEnrollPage", ["error" => $error, "message" => $message, "data" => $data]);
        return new HttpResponse($view);
    }

    public function enrollPost(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("student")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        $formData = $request->getParamsPost();
        $courseId = $formData["courseId"];

        $course = $this->courseMapper->findById($courseId);
        if ($course == null) {
            return $this->getRedirect("enroll", ["error" => "course-not-available"]);
        }
        $user = $this->userMapper->findById($this->sessionManager->get("id"));

        if ($this->courseEnrollmentMapper->findByCourseStudentId($course->getId(), $user->getId()) != null) {
            return $this->getRedirect("enroll", ["error" => "already-enrolled-for-this-course"]);
        }

        var_dump($courseId);

        $courseEnrollment = new CourseEnrollment($course->getId(), $user->getId());
        $this->courseEnrollmentMapper->insert($courseEnrollment);

        return $this->getRedirect("enroll", ["message" => "succesfully-enrolled"]);
    }
}