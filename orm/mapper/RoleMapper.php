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

        if (!$rows) {
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

        if (!$row) {
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

        if (!$row) {
            return null;
        }

        return new Role($row["role_name"], $row["id"]);
    }

    public function insert(Role $role)
    {
        $roleName = $role->getRoleName();

        $statement = "INSERT INTO role (role_name) VALUES (?);";
        $sth = $this->conn->prepare($statement);
        return $sth->execute([$roleName]);
    }

    public function update(Role $role)
    {
        $id = $role->getId();
        $roleName = $role->getRoleName();

        $statement = "UPDATE role SET role_name = ? WHERE id = ?;";
        $sth = $this->conn->prepare($statement);
        return $sth->execute([$roleName, $id]);
    }

    public function delete(Role $role)
    {
        try {
            $id = $role->getId();
            $statement = " DELETE FROM role WHERE id = ?;";
            $sth = $this->conn->prepare($statement);
            return $sth->execute([$id]);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
