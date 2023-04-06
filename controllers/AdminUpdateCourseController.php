<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminUpdateCourseController extends Controller
{
    public function adminUpdateCourse(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole("admin")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect("adminCourses");
        }

        $course = $this->courseMapper->findById($id);
        if ($course == null) {
            return $this->getRedirect("adminCourses");
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render(
            "AdminUpdateCoursePage",
            ["error" => $error,
            "message" => $message,
            "course" => $course]
        );
        return new HttpResponse($view);
    }

    public function adminUpdateCoursePost(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole("admin")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect("adminCourses");
        }

        $course = $this->courseMapper->findById($id);
        if ($course == null) {
            return $this->getRedirect("adminCourses");
        }

        // extract form
        $formData = $request->getParamsPost();
        $courseName = $formData["courseName"];
        $courseYear = $formData["CourseYear"];
        $examinorId = $formData["CourseExaminorId"];
 
        //validate year
        if (!is_numeric($courseYear) || (int) $courseYear < 2020) {
            return $this->getRedirect(
                "adminCourses",
                ["error" => "invalid-year"]
            );
        }
 
        //validate examinor
        if (!is_numeric($examinorId)) {
            return $this->getRedirect(
                "adminCourses",
                ["error" =>
                "invalid-examinor"]
            );
        }
 
        $examinor = $this->userMapper->findById($examinorId);
 
        if ($examinor == null) {
            return $this->getRedirect(
                "adminCourses",
                ["error" => "invalid-examinor"]
            );
        }
 
        if ($this->roleMapper->findById($examinor->getRoleId())->getRoleName() != "teacher") {
            return $this->getRedirect(
                "adminCourses",
                ["error" => "invalid-examinor"]
            );
        }
 
        //validate course name
        if (strlen($courseName) < 5) {
            return $this->getRedirect(
                "adminCourses",
                ["error" => "course-name-needs-to-be-longer"]
            );
        }

        $course->setCourseName($courseName);
        $course->setYear($courseYear);
        $course->setExaminorId($examinorId);

        $succes = $this->courseMapper->update($course);

        if (!$succes) {
            return $this->getRedirect(
                "adminCourses",
                ["error" => "something-went-wrong"]
            );
        }
        return $this->getRedirect(
            "adminCourses",
            ["message" => "course-updated"],
        );
    }
}
