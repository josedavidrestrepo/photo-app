<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */

include_once 'c:/xampp/htdocs/photoapp/db/dao/UsersDao.php';
include_once 'c:/xampp/htdocs/photoapp/core/controllers/SessionController.php';
include_once 'c:/xampp/htdocs/photoapp/core/controllers/RoutingController.php';

class LoginController
{
    private $data;

    function __construct()
    {
        $this->data = new stdClass();
        $this->data->error = false;
        $this->data->message = "";
    }

    public function load()
    {
        require_once '../../app/login/login.php';
    }

    public function login($username, $password)
    {
        $usersDao = new UsersDao();

        if ($user = $usersDao->getUser($username,$password))
        {
            SessionController::createSession($user);
            RoutingController::redirect('http://localhost/photoapp/app/home');
        }
        else
        {
            $this->data->error = true;
            $this->data->message = $usersDao->getResponse();
        }
    }

    public function register($name, $username, $password, $avatar)
    {
        $usersDao = new UsersDao();

        if ($usersDao->insertUser($name, $username, $password, $avatar))
        {
            $this->data->error = false;
            $this->data->message = "User created successfully. Please login";
        }
        else
        {
            $this->data->error = true;
            $this->data->message = $usersDao->getResponse();
        }
    }

    public function logout()
    {
        SessionController::deleteSession();
        RoutingController::redirect('http://localhost/photoapp');
    }
}