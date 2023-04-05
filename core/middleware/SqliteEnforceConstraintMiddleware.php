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
    public function process(HttpRequest $request, RequestHandlerInterface $handler): HttpResponse
    {
        //needed to enforce sqlite foreign keys
        $statement = "PRAGMA foreign_keys = ON;";
        $sth = $this->conn->prepare($statement);
        $sth->execute();
        return $handler->handle($request);
    }
}