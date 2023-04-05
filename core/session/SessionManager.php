<?php
namespace core\session;

class SessionManager
{
    public function startSession(): void
    {
        session_start();
    }

    public function add(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    public function clearSesssion(): void
    {
        session_destroy();
    }

    public function isLoggedIn()
    {
        return $this->get("id") != null;
    }

    public function hasRole(string $role)
    {
        return ($this->get("role") == $role);
    }
}