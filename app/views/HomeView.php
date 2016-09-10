<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 13:10
 */
class HomeView
{
    private $homeModel;

    function __construct($homeModel)
    {
        $this->homeModel = $homeModel;
    }

    public function printUserName()
    {
        $user = $this->homeModel->getUser();
        if (isset($user))
        {
            echo $user->getUserName();
        }
    }

    public function printName()
    {
        $user = $this->homeModel->getUser();
        if (isset($user))
        {
            echo $user->getName();
        }
    }

}