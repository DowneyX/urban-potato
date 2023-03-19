<?php

use controller\GoognaController;
use controller\HomeController;
use core\Application;
use core\container\Container;
use core\http\message\HttpRequest;
use core\middleware\ErrorHandlingMiddleware;
use core\middleware\MiddlewareStack;
use core\middleware\RoutingMiddleware;
use core\routing\RouteCollection;
use core\templating\TemplateEngine;

echo('<pre>');

require_once(__DIR__ . '/../core/Autoloader.php');
$rerquest = HttpRequest::createRequestFromGlobals();

//register routes
// $routeCollection = new RouteCollection();
// $templateEngine = new TemplateEngine($routeCollection, 'templates');

// $routeCollection->addRoute([new HomeController($templateEngine), 'home'], '/', 'home', ['get']);
// $routeCollection->addRoute([new GoognaController($templateEngine), 'googna'], '/googna', 'googna', ['get']);

//register middleware
// $middlewareStack = new MiddlewareStack();
// $middlewareStack->addMiddleware(new ErrorHandlingMiddleware());
// $middlewareStack->addMiddleware(new RoutingMiddleware($routeCollection));

// run the application
// $app = new Application($rerquest, $routeCollection, $middlewareStack);
// $app->run();


//test
$container = new Container();
$container->get(RouteCollection::class);
$container->get(RoutingMiddleware::class);

var_dump($container);
