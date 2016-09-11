<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 13:09
 */

include_once 'SessionController.php';
include_once 'RoutingController.php';
include_once 'c:/xampp/htdocs/photoapp/core/model/User.php';

class HomeController
{
    private $data;

    function __construct()
    {
        $this->data = new stdClass();
    }

    public function load()
    {
        SessionController::start();

        if ($user = SessionController::getUser())
        {
            $this->data->user = $user;

            require_once '../../app/home/home.php';
        }
        else
        {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

}