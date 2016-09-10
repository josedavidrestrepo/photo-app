<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */

include_once 'c:/xampp/htdocs/photoapp/app/db/dao/UsersDao.php';
include_once 'c:/xampp/htdocs/photoapp/app/controllers/SessionsController.php';

class LoginController
{
    private $loginModel;

    function __construct($loginModel)
    {
        $this->loginModel = $loginModel;
    }

    public function login($username, $password)
    {
        $userDao = new UsersDao();

        if ($user = $userDao->getUser($username,$password))
        {
            SessionsController::createSession($user);
            header('Location: ../home');
            exit();
        }
        else
        {
            $this->loginModel->setError($userDao->getResponse());
        }
    }

    public static function logout()
    {
        SessionsController::deleteSession();
        header('Location: ../../');
    }
}