<?php
namespace core\session;

class SessionManager
{
    /**
     * wil start a session for the client
     */
    public function startSession(): void
    {
        session_start();
    }

    /**
     * wil a value to the session
     */
    public function add(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * wil return a session value
     * @return mixed session value
     */
    public function get(string $key): mixed
    {
        return $_SESSION[$key];
    }

    /**
     * destroys the current session
     */
    public function clearSesssion(): void
    {
        session_destroy();
    }

    /**
     * checks if current session is logged in
     * @return bool true if logged in false otherwise
     */
    public function isLoggedIn(): bool
    {
        return $this->get("id") != null;
    }

    /**
     * checks if current session has the specifeid role
     * @param string name of the role
     * @return bool true if session has role false otherwise
     */
    public function hasRole(string $role): bool
    {
        return ($this->get("role") == $role);
    }
}
