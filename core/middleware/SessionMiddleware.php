<?php

namespace core\middleware;

use core\http\handling\RequestHandlerInterface;
use core\http\HttpRequest;
use core\http\HttpResponse;
use core\session\SessionManager;

class SessionMiddleware implements MiddlewareInterface
{
    private $sessionManager;
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $this->sessionManager->startSession();
        return $handler->handle($request);
    }
}