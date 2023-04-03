<?php

namespace orm\entities;

class Role
{
    private int $id;
    private string $roleName;

    public function __construct(string $RoleName, int $id = 0)
    {
        $this->id = $id;
        $this->roleName = $RoleName;
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getRoleName()
    {
        return $this->roleName;
    }

}