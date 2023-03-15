<?php

//echo('<pre>');
use Controller\GoognaController;
use Controller\HomeController;
use Core\Application;

require_once(__DIR__ . '/../Core/Autoloader.php');

$app = new Application();

//register routes
$app->addRoute([new HomeController(), 'home'], '/', ['get']);
$app->addRoute([new GoognaController(), 'googna'], '/googna', ['get']);

//register middleware

// run the application

$app->run();
