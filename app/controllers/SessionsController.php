<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */
class SessionsController
{

    public static function createSession($user)
    {
        session_start();

        $_SESSION = array();

        $_SESSION["userId"] = $user->getUserId();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["name"] = $user->getName();
        $_SESSION["avatar"] = $user->getAvatar();

    }

    public static function deleteSession()
    {
        // Initialize the session.
        // If you are using session_name("something"), don't forget it now!
        session_start();

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
    }

    public static function isSessionStarted()
    {
        return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    }
}