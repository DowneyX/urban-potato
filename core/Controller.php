<?php

namespace core;

use core\http\HttpResponse;
use core\session\SessionManager;
use core\templating\TemplateEngine;
use core\templating\UrlGenerator;
use orm\mapper\CourseEnrollmentMapper;
use orm\mapper\RoleMapper;
use orm\mapper\UserMapper;
use orm\mapper\CourseMapper;

class Controller
{
    private TemplateEngine $templateEngine;
    private UrlGenerator $urlGenerator;
    protected SessionManager $sessionManager;
    protected UserMapper $userMapper;
    protected RoleMapper $roleMapper;
    protected CourseMapper $courseMapper;
    protected CourseEnrollmentMapper $courseEnrollmentMapper;
    public function __construct(
        TemplateEngine $templateEngine,
        UrlGenerator $urlGenerator,
        SessionManager $sessionManager,
        UserMapper $userMapper,
        RoleMapper $roleMapper,
        CourseMapper $courseMapper,
        CourseEnrollmentMapper $courseEnrollmentMapper
    ) {
        $this->templateEngine = $templateEngine;
        $this->urlGenerator = $urlGenerator;
        $this->roleMapper = $roleMapper;
        $this->userMapper = $userMapper;
        $this->sessionManager = $sessionManager;
        $this->courseMapper = $courseMapper;
        $this->courseEnrollmentMapper = $courseEnrollmentMapper;
    }

    protected function render(string $fileName, array $params = []): string
    {
        return $this->templateEngine->render($fileName, $params);
    }

    /**
     * will generate a HttpResponse object with a specific location header
     * @param string $routeName route to redirect to
     * @param array $paramsGet optional query parameters for the redirected route
     * @param array $routeParams optional route specific parameters
     */
    protected function getRedirect(string $routeName, array $paramsGet = [], array $routeParams = []): HttpResponse
    {
        $response = new HttpResponse();
        $url = $this->urlGenerator->getUrlFor($routeName, $routeParams);

        if (!empty($paramsGet)) {
            $url = $url . "?";
        }

        foreach ($paramsGet as $key => $value) {
            $url = $url . $key . "=" . $value . "&";
        }

        $response = $response->withHeaders(["Location" => $url]);
        return $response;
    }
}
