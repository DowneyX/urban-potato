<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;
use orm\entities\Course;



class AdminCreateCourseController extends Controller
{
    public function adminCreateCourse(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        $view = $this->render("AdminCreateCoursePage");
        return new HttpResponse($view);

    }

    public function adminCreateCoursePost(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        // extract form
        $formData = $request->getParamsPost();
        $courseName = $formData["courseName"];
        $courseYear = $formData["CourseYear"];
        $examinorId = $formData["CourseExaminorId"];

        //validate year
        if (!is_numeric($courseYear) || (int) $courseYear < 2020) {
            return $this->getRedirect("adminCreateCourse", ["error" => "invalid-year"]);
        }

        //validate examinor
        if (!is_numeric($examinorId)) {
            return $this->getRedirect("adminCreateCourse", ["error" => "invalid-examinor"]);
        }

        $examinor = $this->userMapper->findById($examinorId);

        if ($examinor == null) {
            return $this->getRedirect("adminCreateCourse", ["error" => "invalid-examinor"]);
        }

        if ($this->roleMapper->findById($examinor->getRoleId())->getRoleName() != "teacher") {
            return $this->getRedirect("adminCreateCourse", ["error" => "invalid-examinor"]);
        }

        //validate course name
        if (strlen($courseName) < 5) {
            return $this->getRedirect("adminCreateCourse", ["error" => "course name needs to be longer"]);
        }

        $course = new Course($courseName, $courseYear, $examinorId);

        $succes = $this->courseMapper->insert($course);

        if (!$succes) {
            return $this->getRedirect("adminCreateCourse", ["error" => "something went wrong adding this course"]);
        }

        return $this->getRedirect("adminCourses", ["message" => "course has been succesfully added"]);
    }
}