<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */
include 'c:/xampp/htdocs/photoapp/db/dao/LoginDao.php';

class LoginController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function login($username, $password)
    {
        $userDao = new LoginDao();
        if ($userDao->validateUser($username,$password))
        {
            $this->model->setMessage("Logged in");
            return true;
        }
        else
        {
            $this->model->setMessage($userDao->error);
            return false;
        }
    }
}