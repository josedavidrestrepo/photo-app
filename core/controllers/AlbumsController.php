<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */

include_once 'c:/xampp/htdocs/photoapp/db/dao/AlbumsDao.php';
include_once 'SessionController.php';
include_once 'RoutingController.php';

class AlbumsController
{
    private $data;

    function __construct()
    {
        $this->data = new stdClass();
        $this->data->error = false;
        $this->data->message = "";
    }

    public function loadNewAlbum()
    {
        if ($user = SessionController::getUser()) {
            $this->data->user = $user;

            require_once '../../app/albums/new-album.php';
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function createAlbum($albumName, $albumDescription)
    {
        $albumsDao = new AlbumsDao();
        $user = SessionController::getUser();

        if ($albumsDao->insertAlbum($albumName, $albumDescription, $user)) {
            $this->data->error = false;
            $this->data->message = "Album created successfully";
        } else {
            $this->data->error = true;
            $this->data->message = $albumsDao->getResponse();
        }
    }
}