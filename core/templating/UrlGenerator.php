<?php

namespace core\templating;

use core\routing\RouteCollection;

class UrlGenerator
{
    private $routeCollection;
    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }
    protected function getUrlFor(string $name)
    {
        $this->routeCollection->getPath($name);
    }
}