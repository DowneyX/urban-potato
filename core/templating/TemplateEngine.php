<?php

namespace core\templating;

use core\routing\RouteCollection;
use Exception;

class TemplateEngine
{
    private string $directory;
    private string $fileExtension = "php";
    private RouteCollection $routeCollection;

    public function __construct(RouteCollection $routeCollection, string $directory)
    {
        $this->routeCollection = $routeCollection;
        $this->directory = $directory;
    }

    public function render($fileName, array $params = []): string
    {
        $filePath = __DIR__ . "/../../" . $this->directory . '/' . $fileName . '.' . $this->fileExtension;
        // check if file exist else throw exeption
        if (!file_exists($filePath)) {
            throw new Exception("can't find template in: " . $filePath, 1);
        }

        // inject parameters
        extract($params);
        ob_start();
        include($filePath);

        // return string of template with complete code
        return (string) ob_get_clean();
    }

    protected function getUrlFor(string $string)
    {
        return $this->routeCollection->getPath($string);
    }
}