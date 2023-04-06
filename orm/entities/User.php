<?php

namespace orm\entities;

class User
{
    private int $id;
    private string $email;
    private string $salt;
    private string $hash;
    private int $roleId;

    public function __construct(string $email, string $salt, string $hash, int $roleId, int $id = 0)
    {
        $this->id = $id;
        $this->email = $email;
        $this->salt = $salt;
        $this->hash = $hash;
        $this->roleId = $roleId;
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }
}
