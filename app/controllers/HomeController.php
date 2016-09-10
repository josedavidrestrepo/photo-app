<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 13:09
 */

include_once 'SessionsController.php';
include_once 'c:/xampp/htdocs/photoapp/app/entities/User.php';

class HomeController
{
    private $homeModel;

    function __construct($homeModel)
    {
        $this->homeModel = $homeModel;
    }

    public function load()
    {
        if (!SessionsController::isSessionStarted())
            session_start();

        if (isset($_SESSION["userId"]))
        {
            $user = new User();

            $user->setUserId($_SESSION["userId"]);
            $user->setUsername($_SESSION["username"]);
            $user->setName($_SESSION["name"]);
            $user->setAvatar($_SESSION["avatar"]);

            $this->homeModel->setUser($user);
        }
        else
        {
            header('Location: ../../');
        }
    }

}