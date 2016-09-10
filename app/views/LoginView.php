<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 14:05
 */
class LoginView
{
    private $loginModel;

    function __construct($loginModel)
    {
        $this->loginModel = $loginModel;
    }

    public function printError()
    {
        echo $this->loginModel->getError();
    }
}