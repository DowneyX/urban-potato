<?php
use controller\GoognaController;
use controller\HomeController;
use core\Application;
use core\HttpRequest;
use core\middleware\ErrorHandlingMiddleware;
use core\middleware\MiddlewareStack;
use core\middleware\RoutingMiddleware;
use core\routing\RouteCollection;

//echo('<pre>');

require_once(__DIR__ . '/../core/Autoloader.php');
$rerquest = HttpRequest::createRequestFromGlobals();

//register routes
$routeCollection = new RouteCollection();
$routeCollection->addRoute([new HomeController(), 'home'], '/', ['get']);
$routeCollection->addRoute([new GoognaController(), 'googna'], '/googna', ['get']);

//register middleware
$middlewareStack = new MiddlewareStack();
$middlewareStack->addMiddleware(new ErrorHandlingMiddleware());
$middlewareStack->addMiddleware(new RoutingMiddleware($routeCollection));

// run the application
$app = new Application($rerquest, $routeCollection, $middlewareStack);
$app->run();


//test
//$googa = $routes->getCallback('floopy', 'get');
