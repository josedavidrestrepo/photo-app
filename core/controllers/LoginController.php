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
        if ($user = SessionController::getUser()) {
            RoutingController::redirect('/photoapp/app/home');
        } else {
            require_once '../../app/login/login.php';
        }

    }

    public function login($username, $password)
    {
        $usersDao = new UsersDao();

        if ($user = $usersDao->getUserByUserName($username)) {
            if (password_verify($password, $user->getPassword())) {
                SessionController::createSession($user);
                RoutingController::redirect('/photoapp/app/home');
            } else {
                $this->data->error = true;
                $this->data->message = "Your username or password is invalid";
            }
        } else {
            $this->data->error = true;
            $this->data->message = $usersDao->getResponse();
        }
    }

    public function register($name, $username, $password, $avatar, $role)
    {
        if ($role >= 1 && $role <= 3) {
            $usersDao = new UsersDao();
            $password = password_hash($password, PASSWORD_DEFAULT);

            if ($usersDao->insertUser($name, $username, $password, $avatar, $role)) {
                $this->data->error = false;
                $this->data->message = "User created successfully. Please login";
            } else {
                $this->data->error = true;
                $this->data->message = $usersDao->getResponse();
            }
        } else {
            $this->data->error = true;
            $this->data->message = "Must choose the role";
        }
    }

    public function logout()
    {
        SessionController::deleteSession();
        RoutingController::redirect('/photoapp');
    }
}