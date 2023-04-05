<?php

namespace controllers;

use core\Controller;
use core\http\HttpRequest;
use core\http\HttpResponse;

class AdminUsersAdminsController extends Controller
{
    public function usersGet(HttpRequest $request): HttpResponse
    {
        if (!$this->sessionManager->hasRole("admin")) {
            return new HttpResponse("403 Forbidden", 403);
        }

        $users = $this->userMapper->fetchWithRole(3);
        $data = [];
        foreach ($users as $key => $value) {
            $data[] =
                [
                    "user" => $value,
                    "role" => $this->roleMapper->findById($value->getRoleId()),
                ];
        }

        $message = $request->getParamGet("message");
        $error = $request->getParamGet("error");
        $view = $this->render("AdminUsersAdminsPage", ["error" => $error, "message" => $message, "data" => $data]);
        return new HttpResponse($view);
    }
}