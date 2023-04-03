<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;
use orm\entities\User;



class AdminCreateUserController extends Controller
{
    public function createUserGet(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        $view = $this->render("AdminCreateUserPage");
        return new HttpResponse($view);

    }

    public function createUserPost(HttpRequest $request): HttpResponse
    {

        // extract form
        $formData = $request->getParamsPost();
        $email = $formData["email"];
        $password = $formData["password"];
        $password2 = $formData["confirm-password"];
        $role = $formData["role"];

        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->getRedirect("createUserGet", ["error" => "invalid-email"]);
        }

        if ($this->userMapper->findByEmail($email) != null) {
            return $this->getRedirect("createUserGet", ["error" => "email-taken"]);
        }

        // vallidate role
        if ($role != 'student' && $role != 'teacher' && $role != 'admin') {
            return $this->getRedirect("createUserGet", ["error" => "invalid-role"]);
        }

        // vallidate password
        if (strlen($password) < 8) {
            return $this->getRedirect("createUserGet", ["error" => "password-is-not-long-enough"]);
        }

        if ($password != $password2) {
            return $this->getRedirect("createUserGet", ["error" => "passwords-do-not-match"]);
        }

        //setup user object
        $salt = "ad5Ads";
        $hash = password_hash($salt . $password, PASSWORD_DEFAULT);

        $roleObject = $this->roleMapper->findByRoleName($role);
        if ($roleObject == null) {
            return $this->getRedirect("createUserGet", ["error" => "role-does-not-exist"]);
        }


        //insert user into database
        $user = new User($email, $salt, $hash, $roleObject->getId());
        $this->userMapper->insert($user);
        return $this->getRedirect("createUserGet", ["message" => "user-created-seccesfully"]);
    }
}