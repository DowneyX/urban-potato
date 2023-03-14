<?php

namespace Vendor\Http\Message;

class HttpResponse
{
    private string $content;
    private string $method;
    private string $protocolVersion;
    private array $headers;
    private int $statusCode;
    private string $path;
    private string $scheme;
    private string $host;
    private int $port;
    private array $paramsGet;
    public static $statusPhrase = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Content Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Content',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];
    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this-> content = $content;
        $this-> statusCode = $statusCode;
        $this-> headers = $headers;
        $this-> protocolVersion = '1.0';
    }

    public function getContent(): string
    {
        return $this->content;
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

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getStatusPhrase(): string
    {
        $phrase = $this -> statusPhrase[$this -> statusCode];
        return $phrase;
    }

    public function getHeader($name)
    {
    }

    public function getScheme()
    {
        return $this->scheme;
    }
    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        $this -> port;
    }

    public function getPath()
    {
        $this->path;
    }

    public function getParamsGet()
    {
        $this->paramsGet;
    }
    public function getParamGet(string $name)
    {
        $this->paramsGet[$name];
    }

    public function sendContent()
    {
        echo($this->content);
    }

    public function sendHeaders()
    {
        foreach ($this -> headers as $name => $value) {
            header($name . ': ' . $value);
        }
    }

    public function sendStatus()
    {
        http_response_code($this -> statusCode);
    }

    public function send()
    {
        $this -> sendContent();
        $this -> sendHeaders();
        $this -> sendStatus();
    }
}
