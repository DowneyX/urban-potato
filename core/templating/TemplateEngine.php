<?php

namespace core\templating;

use Exception;

class TemplateEngine
{
    private $directory = "../templates";
    private $fileExtension = "php";
    public function __construct()
    {
    }

    public function render($fileName, array $params = [])
    {
        $filePath = $this->directory . '/' . $fileName . '.' . $this->fileExtension;

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
}
