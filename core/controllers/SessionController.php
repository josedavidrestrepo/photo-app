<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */

include_once 'c:/xampp/htdocs/photoapp/core/models/User.php';
include_once 'c:/xampp/htdocs/photoapp/core/models/Person.php';

class SessionController
{

    public static function createSession($user)
    {
        self::start();

        $_SESSION = array();

        $_SESSION["userId"] = $user->getUserId();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["name"] = $user->getPerson()->getName();
        $_SESSION["avatar"] = $user->getAvatar();
    }

    public static function start()
    {
        if (!(session_status() === PHP_SESSION_ACTIVE))
            session_start();
    }

    public static function deleteSession()
    {
        self::start();

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

    public static function getUser()
    {
        self::start();

        if (isset($_SESSION["userId"]))
        {
            $person = new Person();

            $person->setName($_SESSION["name"]);

            $user = new User();

            $user->setUserId($_SESSION["userId"]);
            $user->setUsername($_SESSION["username"]);
            $user->setAvatar($_SESSION["avatar"]);

            $user->setPerson($person);

            return $user;
        }
        else
        {
            return NULL;
        }
    }
}