<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;



class AdminDeleteUserController extends Controller
{
    public function adminDeleteUser(HttpRequest $request, string $id): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        if (!is_numeric($id)) {
            return $this->getRedirect("home", ["error" => "invalid-user-id"]);
        }

        $user = $this->userMapper->findById($id);
        if ($user == null) {
            return $this->getRedirect("home", ["error" => "invalid-user-id"]);
        }

        if ($this->courseMapper->fetchAllWithExaminorId($id) != null) {
            return $this->getRedirect("home", ["error" => "this-user-is-the-examinor-for-a-course"]);
        }

        if ((int) $id == (int) $this->sessionManager->get("id")) {
            return $this->getRedirect("home", ["error" => "you-can-not-delete-yourself"]);
        }

        $succes = $this->userMapper->delete($user);

        if (!$succes) {
            return $this->getRedirect("home", ["error" => "something-went-wrong-deleting-this-user"]);
        }

        return $this->getRedirect("home", ["message" => "user-deleted"]);
    }
}