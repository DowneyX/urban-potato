<?php

namespace core\http;

class HttpResponse
{
    private string $content;
    private array $headers;
    private int $statusCode;

    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeader(string $key): string
    {
        return $this->headers[$key];
    }

    public function sendContent(): void
    {
        echo ($this->content);
    }

    public function sendHeaders(): void
    {
        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value);
        }
    }

    public function sendStatus(): void
    {
        http_response_code($this->statusCode);
    }

    public function send(): void
    {
        $this->sendStatus();
        $this->sendHeaders();
        $this->sendContent();

    }

    public function withHeaders(array $headers)
    {
        $headerArrayCopy = $this->getHeaders();
        foreach ($headers as $key => $value) {
            $headerArrayCopy[$key] = $value;
        }

        return new HttpResponse($this->content, $this->statusCode, $headerArrayCopy);

    }
}