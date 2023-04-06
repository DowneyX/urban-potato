<?php

namespace core\templating;

use core\session\SessionManager;
use Exception;

class TemplateEngine
{
    private string $directory;
    private string $fileExtension = "php";
    private UrlGenerator $urlGenerator;
    private SessionManager $sessionManager;

    public function __construct(UrlGenerator $urlGenerator, string $directory, SessionManager $sessionManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->directory = $directory;
        $this->sessionManager = $sessionManager;
    }

    /**
     * will render template as a string
     * @param string $filename name of template
     * @param array $params parameters that can be used in the template
     * @return string a string representation of the website
     */
    public function render(string $fileName, array $params = []): string
    {
        $filePath = __DIR__ . "/../../" . $this->directory . '/' . $fileName . '.' . $this->fileExtension;
        // check if file exist else throw exeption
        if (!file_exists($filePath)) {
            throw new Exception("can't find template in: " . $filePath, 1);
        }

        // inject parameters
        extract($params);

        ob_start();
        try {
            include($filePath);
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
        $output = (string) ob_get_clean();

        return $output;
    }

    /**
     * will get the url with a specific name accociated with it
     * @param string $name name of the route
     * @param array $params optional route parameters
     * @return string the url
     */
    public function getUrlFor(string $name, array $params = []): string
    {
        return $this->urlGenerator->getUrlFor($name, $params);
    }
}
