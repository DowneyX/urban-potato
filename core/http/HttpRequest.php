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

    /**
     * returns the http method of this request
     * @return string sting of the http method
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * returns an associative array of all the headers in this request
     * @return array array with headers.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * returns a specified header
     * @param string $key the name of the header from which you want the value
     * @return string|null the value of the specified header
     */
    public function getHeader(string $key): string|null
    {
        return $this->headers[$key];
    }

    /**
     * returns te path of the current request
     * @return string path of current request
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * returns an array with the post parameters of this request
     * @return array post parameters
     */
    public function getParamsPost(): array
    {
        return $this->paramsPost;
    }

    /**
     * returns an array with the get parameters of this request
     * @return array get parameters
     */
    public function getParamsGet(): array
    {
        return $this->paramsGet;
    }

    /**
     * returns an array with the file parameters of this request
     * @return array file parameters
     */
    public function getParamsFile(): array
    {
        return $this->paramsFile;
    }

    /**
     * returns the value of a specified get parameter
     * @param string $key the name of the get parameter from which you want the value
     * @return string|null value of specifeid get parameter
     */
    public function getParamGet(string $key): string|null
    {
        return $this->paramsGet[$key];
    }

    /**
     * returns an instance of the httpRequest class based on the php superglobal
     * varriables.
     * @return HttpRequest the request instance made with the superglobals
     */
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
