<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;
use orm\entities\Course;
use orm\entities\CourseEnrollment;

class AdminEnrollStudentController extends Controller
{
    public function adminEnrollStudent(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect("adminUsersStudents");
        }

        $user = $this->userMapper->findById($id);
        if ($user == null) {
            return $this->getRedirect("adminUsersStudents");
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render(
            "AdminEnrollStudentPage",
            ["error" => $error,
            "message" => $message,
            "studentId" => $id]
        );
        return new HttpResponse($view);
    }

    public function adminEnrollStudentPost(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect("adminUsersStudents");
        }

        $user = $this->userMapper->findById($id);
        if ($user == null) {
            return $this->getRedirect("adminUsersStudents");
        }

        // extract form
        $formData = $request->getParamsPost();
        $studentId = $formData["studentId"];
        $courseId = $formData["courseId"];

        //validate student
        if (!is_numeric($studentId)) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-studentId"]
            );
        }

        $student = $this->userMapper->findById($studentId);

        if ($student == null) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-studentId"]
            );
        }

        if ($this->roleMapper->findById($student->getRoleId())->getRoleName() != "student") {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-studentId"]
            );
        }

        //validate course
        if (!is_numeric($courseId)) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-course"]
            );
        }

        $course = $this->courseMapper->findById($courseId);

        if ($course == null) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-course"]
            );
        }

        //validate that enrollment doesnt exist already

        if ($this->courseEnrollmentMapper->findByCourseStudentId($courseId, $studentId) != null) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "student-already-enrolled-for-this-course"]
            );
        }

        $enrollment = new CourseEnrollment($courseId, $studentId);

        $succes = $this->courseEnrollmentMapper->insert($enrollment);

        if (!$succes) {
            return $this->getRedirect(
                "adminEnrollments",
                ["error" => "something-went-wrong-adding-this-course",
                [$id]]
            );
        }

        return $this->getRedirect(
            "adminEnrollments",
            ["message" => "enrollment-has-been-succesfully-added"],
            [$id]
        );
    }
}
