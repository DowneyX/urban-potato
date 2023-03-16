<?php

//echo('<pre>');
use Controller\GoognaController;
use Controller\HomeController;
use Core\Application;
use Core\HttpRequest;
use Core\Middleware\ErrorHandlingMiddleware;
use Core\Middleware\MiddlewareStack;
use Core\Middleware\RoutingMiddleware;
use Core\Routing\RouteCollection;

require_once(__DIR__ . '/../Core/Autoloader.php');
$rerquest = HttpRequest::createRequestFromGlobals();

$routeCollection = new RouteCollection();
$routeCollection->addRoute([new HomeController(), 'home'], '/', ['get']);
$routeCollection->addRoute([new GoognaController(), 'googna'], '/googna', ['get']);

$middlewareStack = new MiddlewareStack();
$middlewareStack->addMiddleware(new ErrorHandlingMiddleware());
$middlewareStack->addMiddleware(new RoutingMiddleware($routeCollection));

$app = new Application($rerquest, $routeCollection, $middlewareStack);

//register routes


//register middleware

// run the application

$app->run();


//test
//$googa = $routes->getCallback('floopy', 'get');
