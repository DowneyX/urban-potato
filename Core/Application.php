<?php

namespace Core;

use Core\HttpRequest;
use Core\Middleware\MiddlewareStack;
use Core\Routing\Router;

class Application
{
    private Router $router;
    private HttpRequest $request;

    public function __construct()
    {
        $this->request = HttpRequest::createRequestFromGlobals();
        $this->router = new Router();
        //$this->middlewareStack = new MiddlewareStack();
    }

    public function run()
    {
        // run request through middeware

        // run through router
        $response = $this->router->resolve($this->request);

        //send response
        $response->send();
    }

    public function addRoute($callback, string $path, array $methods = ['get'])
    {
        $this->router->addRoute($callback, $path, $methods);
    }
}
