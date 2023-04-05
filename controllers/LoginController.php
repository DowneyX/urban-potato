<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class LoginController extends Controller
{
    public function loginGet(HttpRequest $request): HttpResponse
    {
        //if logged in return to home
        if ($this->sessionManager->isLoggedIn()) {
            return $this->getRedirect("home");
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render("LoginPage", ["error" => $error, "message" => $message]);
        return new HttpResponse($view);
    }

    public function loginPost(HttpRequest $request): HttpResponse
    {
        if ($this->sessionManager->isLoggedIn()) {
            return $this->getRedirect("home");
        }

        //extract form
        $formData = $request->getParamsPost();
        $email = $formData["email"];
        $password = $formData["password"];

        $user = $this->userMapper->findByEmail($email);
        //vallidate user
        if ($user == null) {
            return $this->getRedirect("login", ["error" => "invalid-credentials"]);
        }

        $role = $this->roleMapper->findById($user->getRoleId());

        //validate password
        if (!password_verify($user->getSalt() . $password, $user->getHash())) {
            return $this->getRedirect("login", ["error" => "invalid-credentials"]);
        }

        $this->sessionManager->add('id', $user->getId());
        $this->sessionManager->add('email', $user->getEmail());
        $this->sessionManager->add('role', $role->getRoleName());

        return $this->getRedirect("home", ["message" => "login-succes"]);
    }

}