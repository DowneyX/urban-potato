<?php

namespace core\middleware;

use core\http\handling\RequestHandlerInterface;
use core\http\HttpRequest;
use core\http\HttpResponse;
use PDO;

class SqliteEnforceConstraintMiddleware implements MiddlewareInterface
{
    private $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * will ensure sqlite enforces foriegnkey constraints.
     * constraints like ON DELETE and ON UPDATE
     * @param HttpRequest $request the request being handled
     * @param RequestHandlerInterface $handler the request handler
     * @return HttpResponse the response
     */
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        $statement = "PRAGMA foreign_keys = ON;";
        $sth = $this->conn->prepare($statement);
        $sth->execute();
        return $handler->handle($request);
    }
}
