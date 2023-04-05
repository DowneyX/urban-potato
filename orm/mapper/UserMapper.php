<?php

namespace orm\mapper;

use orm\entities\User;
use PDO;

class UserMapper
{
    private PDO $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function fetchAll()
    {
        $statement = "SELECT * FROM user;";
        $sth = $this->conn->prepare($statement);
        $sth->execute();
        $rows = $sth->fetchAll();

        if ($rows == false) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new User($value["email"], $value['salt'], $value["hash"], $value["role_id"], $value["id"]);
        }
        return $returnArray;
    }

    public function fetchWithRole(int $roleId)
    {
        $statement = "SELECT * FROM user WHERE role_id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$roleId]);
        $rows = $sth->fetchAll();

        if ($rows == false) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new User($value["email"], $value['salt'], $value["hash"], $value["role_id"], $value["id"]);
        }
        return $returnArray;
    }

    public function findById($id)
    {
        $statement = "SELECT * FROM user WHERE id = ?";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $row = $sth->fetch();



        if ($row == false) {
            return null;
        }

        return new User($row["email"], $row['salt'], $row["hash"], $row["role_id"], $row["id"]);
    }

    public function findByEmail(string $email)
    {
        $statement = "SELECT * FROM user WHERE email = ?";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$email]);
        $row = $sth->fetch();

        if ($row == false) {
            return null;
        }

        return new User($row["email"], $row['salt'], $row["hash"], $row["role_id"], $row["id"]);
    }

    public function insert(User $user)
    {
        $email = $user->getEmail();
        $salt = $user->getSalt();
        $hash = $user->getHash();
        $roleId = $user->getRoleId();

        $statement = "INSERT INTO user (email, salt, hash, role_id) VALUES (?, ?, ?, ?);";
        $sth = $this->conn->prepare($statement);
        return $sth->execute([$email, $salt, $hash, $roleId]);
    }

    public function delete(User $user)
    {
        try {
            $id = $user->getId();
            $statement = " DELETE FROM user WHERE id = ?;";
            $sth = $this->conn->prepare($statement);
            return $sth->execute([$id]);
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function update(User $user)
    {
    }
}