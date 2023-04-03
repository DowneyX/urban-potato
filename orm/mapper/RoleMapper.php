<?php

namespace orm\mapper;

use orm\entities\Role;
use PDO;

class RoleMapper
{
    private PDO $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function fetchAll()
    {
        $statement = "SELECT * FROM role;";
        $sth = $this->conn->prepare($statement);
        $sth->execute();
        $rows = $sth->fetchAll();

        if (!isset($rows)) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new Role($value["role_name"], $value["id"]);
        }
        return $returnArray;
    }

    public function findById($id)
    {
        $statement = "SELECT * FROM role WHERE id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $row = $sth->fetch();

        if (!isset($row)) {
            return null;
        }

        return new Role($row["role_name"], $row["id"]);
    }

    public function findByRoleName($roleName)
    {
        $statement = "SELECT * FROM role WHERE role_name = ?";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$roleName]);
        $row = $sth->fetch();

        if (!isset($row)) {
            return null;
        }

        return new Role($row["role_name"], $row["id"]);
    }
}