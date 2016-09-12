<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 13:09
 */

include_once 'SessionController.php';
include_once 'RoutingController.php';
include_once 'c:/xampp/htdocs/photoapp/core/models/User.php';
include_once 'c:/xampp/htdocs/photoapp/db/dao/AlbumsDao.php';

class HomeController
{
    private $data;

    function __construct()
    {
        $this->data = new stdClass();
    }

    public function load()
    {
        if ($user = SessionController::getUser())
        {
            $albumsDao = new AlbumsDao();

            if ($albums = $albumsDao->getAlbums($user)) {
                $user->setAlbums($albums);
            }

            $this->data->user = $user;

            require_once '../../app/home/home.php';
        }
        else
        {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

}