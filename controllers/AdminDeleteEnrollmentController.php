<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminDeleteEnrollmentController extends Controller
{
    public function adminDeleteEnrollment(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-course-id"]
            );
        }

        $enrollement = $this->courseEnrollmentMapper->findById($id);
        if ($enrollement == null) {
            return $this->getRedirect(
                "adminUsersStudents",
                ["error" => "invalid-course-id"]
            );
        }

        $succes = $this->courseEnrollmentMapper->delete($enrollement);

        if (!$succes) {
            return $this->getRedirect(
                "adminEnrollments",
                ["error" => "something-went-wrong"],
                [$id]
            );
        }
        return $this->getRedirect(
            "adminEnrollments",
            ["message" => "enrollment-deleted"],
            [$id]
        );
    }
}
