<?php

//echo('<pre>');
use Vendor\Http\Message\HttpRequest;
use Vendor\Http\Message\HttpResponse;

require_once('Vendor/Autoloader.php');

$request = HttpRequest::createRequestFromGlobals();

$googa = $request->getParamGet('googa');

$repsonse = new HttpResponse($googa, 200);
$repsonse->send();
