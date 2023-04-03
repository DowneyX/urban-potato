<?php

namespace core\http;

class HttpRequest
{
    private string $method;
    private array $headers;
    private string $path;
    private array $paramsGet;
    private array $paramsPost;
    private array $paramsFile;

    public function __construct(
        string $method = '',
        array $headers = [],
        string $path = '',
        array $paramsGet = [],
        array $paramsPost = [],
        array $paramsFile = [],
    ) {
        $this->method = $method;
        $this->headers = $headers;
        $this->path = $path;
        $this->paramsGet = $paramsGet;
        $this->paramsPost = $paramsPost;
        $this->paramsFile = $paramsFile;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $key): string
    {
        return $this->headers[$key];
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParamsPost(): array
    {
        return $this->paramsPost;
    }

    public function getParamsGet(): array
    {
        return $this->paramsGet;
    }

    public function getParamsFile(): array
    {
        return $this->paramsFile;
    }

    public function getParamGet(string $key): string|null
    {
        return $this->paramsGet[$key];
    }

    public static function createRequestFromGlobals(): HttpRequest
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
            "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $parsedUrl = parse_url($url);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $parsedUrl['path'];
        $paramsGet = $_GET != null ? $_GET : [];
        $paramsPost = $_POST != null ? $_POST : [];
        $paramsFile = $_FILES != null ? $_FILES : [];


        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }

        return new HttpRequest(
            $method,
            $headers,
            $path,
            $paramsGet,
            $paramsPost,
            $paramsFile,
        );
    }
}