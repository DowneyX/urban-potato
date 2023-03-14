<?php

//echo('<pre>');
use Controller\HomeController;
use Middleware\AuthenticationMiddleware;
use Middleware\AuthorizationMiddleware;
use Middleware\MiddlewareStack;
use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;

require_once('Vendor/Autoloader.php');

// $request = HttpRequest::createRequestFromGlobals();
// var_dump($request);
$finalHandler = new HomeController();

$middlewareStack = new MiddlewareStack($finalHandler);
$middlewareStack->add(new AuthenticationMiddleware());
$middlewareStack->add(new AuthorizationMiddleware());

$request = HttpRequest::createRequestFromGlobals();

$response = $middlewareStack->handle($request);

$response->send();
