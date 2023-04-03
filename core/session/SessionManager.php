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
        // i don't know how to store session varriables without this superglobal
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        // i don't know how to get session varriables without this superglobal
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