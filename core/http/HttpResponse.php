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

    /**
     * returns the content of this response
     * @return string content of the response
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * returns an accociative array of the headers
     * @return array header array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * returns the status code of this response
     * @return int http status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
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
     * will send the content to the client
     */
    public function sendContent(): void
    {
        echo ($this->content);
    }

    /**
     * will send the headers to the client
     */
    public function sendHeaders(): void
    {
        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value);
        }
    }

    /**
     * will send the status code to the client
     */
    public function sendStatus(): void
    {
        http_response_code($this->statusCode);
    }

    /**
     * will send the response to the client
     */
    public function send(): void
    {
        $this->sendStatus();
        $this->sendHeaders();
        $this->sendContent();
    }

    /**
     * returns an instance with the information of the current response instance
     * pluss the headers given.
     * @param array $headers accociative array containing headers
     * @return HttpResponse the new instance containing the headers;
     */
    public function withHeaders(array $headers): HttpResponse
    {
        $headerArrayCopy = $this->getHeaders();
        foreach ($headers as $key => $value) {
            $headerArrayCopy[$key] = $value;
        }

        return new HttpResponse($this->content, $this->statusCode, $headerArrayCopy);
    }
}
