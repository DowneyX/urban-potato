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

    /**
     * will ensure a session is always active
     * @param HttpRequest $request the request being handled
     * @param RequestHandlerInterface $handler the request handler
     * @return HttpResponse the response
     */
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $this->sessionManager->startSession();
        return $handler->handle($request);
    }
}
