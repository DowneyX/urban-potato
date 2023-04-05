<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminDeleteCourseController extends Controller
{
    public function adminDeleteCourse(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect("adminCourses", ["error" => "invalid-course-id"]);
        }

        $course = $this->courseMapper->findById($id);
        if ($course == null) {
            return $this->getRedirect("adminCourses", ["error" => "invalid-course-id"]);
        }

        $succes = $this->courseMapper->delete($course);

        if (!$succes) {
            return $this->getRedirect("adminCourses", ["error" => "something-went-wrong"]);
        }
        return $this->getRedirect("adminCourses", ["message" => "course-deleted"]);
    }
}