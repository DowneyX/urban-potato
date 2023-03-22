<?php

use controllers\GoognaController;
use controllers\HomeController;
use core\Application;
use core\container\Container;
use core\middleware\ErrorHandlingMiddleware;
use core\middleware\RoutingMiddleware;
use core\routing\RouteCollection;

require_once(__DIR__ . '/../core/Autoloader.php');

$container = new Container();
$app = $container->get(Application::class);

$app->addMiddleware(new ErrorHandlingMiddleware());
$app->addMiddleware(new RoutingMiddleware($container->get(RouteCollection::class), $container));

$app->addRoute([HomeController::class, 'home'], '/', 'home', ['get']);
$app->addRoute([GoognaController::class, 'googna'], '/googna', 'googna', ['get']);

$app->run();