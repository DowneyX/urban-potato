<?php

namespace core;

use core\templating\TemplateEngine;

class Controller
{
    private TemplateEngine $templateEngine;
    public function __construct(TemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    protected function render(string $fileName, $params = []): string
    {
        return $this->templateEngine->render($fileName, $params);
    }
}