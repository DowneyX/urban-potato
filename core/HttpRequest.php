<?php

namespace core;

class HttpRequest
{
    private string $method;
    private string $protocolVersion;
    private array $headers;
    private string $path;
    private string $scheme;
    private string $host;
    private int $port;
    private array $paramsGet;
    private array $paramsPost;
    private array $paramsFile;

    public function __construct(
        string $method = '',
        string $protocolVersion = '',
        array $headers = [],
        string $path = '',
        string $scheme = '',
        string $host = '',
        int $port = null,
        array $paramsGet = [],
        array $paramsPost = [],
        array $paramsFile = []
    ) {
        $this-> method = $method;
        $this-> protocolVersion = $protocolVersion;
        $this-> headers = $headers;
        $this-> path = $path;
        $this-> scheme = $scheme;
        $this-> host = $host;
        $this-> port = $port;
        $this-> paramsGet = $paramsGet;
        $this-> paramsPost = $paramsPost;
        $this-> paramsFile = $paramsFile;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }


    public function getHeader($key): string
    {
        return $this->headers[$key];
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
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
    /**
     * @param  mixed $name
     * @return mixed
     */
    public function getParamGet(string $name)
    {
        return $this->paramsGet[$name];
    }

    /**
     * @return mixed
     */
    public function getFragment()
    {
    }

    public static function createRequestFromGlobals(): HttpRequest
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
        "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $parsedUrl = parse_url($url);
        $protocol = $_SERVER['SERVER_PROTOCOL'];
        $protocolVersion = substr($protocol, -3);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $parsedUrl['path'];
        $scheme = $parsedUrl['scheme'];
        $host = $parsedUrl['host'];
        $port = $parsedUrl['port'];
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
            $protocolVersion,
            $headers,
            $path,
            $scheme,
            $host,
            $port,
            $paramsGet,
            $paramsPost,
            $paramsFile
        );
    }
}
