<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;
use orm\entities\User;



class AdminCreateAdminController extends Controller
{
    public function adminCreateUser(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole('admin')) {
            return new HttpResponse("403 Forbidden", 403);
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");

        $view = $this->render("AdminCreateAdminPage", ["error" => $error, "message" => $message]);
        return new HttpResponse($view);

    }

    public function adminCreateUserPost(HttpRequest $request): HttpResponse
    {

        // extract form
        $formData = $request->getParamsPost();
        $email = $formData["email"];
        $password = $formData["password"];
        $password2 = $formData["confirm-password"];

        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->getRedirect("adminCreateAdmin", ["error" => "invalid-email"]);
        }

        if ($this->userMapper->findByEmail($email) != null) {
            return $this->getRedirect("adminCreateAdmin", ["error" => "email-taken"]);
        }

        // vallidate password
        if (strlen($password) < 8) {
            return $this->getRedirect("adminCreateAdmin", ["error" => "password-is-not-long-enough"]);
        }

        if ($password != $password2) {
            return $this->getRedirect("adminCreateAdmin", ["error" => "passwords-do-not-match"]);
        }

        //setup user object
        $salt = "ad5Ads";
        $hash = password_hash($salt . $password, PASSWORD_DEFAULT);

        $role = $this->roleMapper->findByRoleName("admin");

        //insert user into database
        $user = new User($email, $salt, $hash, $role->getId());
        $succes = $this->userMapper->insert($user);
        if (!$succes) {
            return $this->getRedirect("adminCreateAdmin", ["error" => "something-went-wrong"]);
        }
        return $this->getRedirect("adminUsersAdmins", ["message" => "user-created-seccesfully"]);
    }
}