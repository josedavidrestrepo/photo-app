<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */

include_once 'c:/xampp/htdocs/photoapp/db/dao/AlbumsDao.php';
include_once 'c:/xampp/htdocs/photoapp/db/dao/ImagesDao.php';
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

            require_once '../../app/albums/new.php';
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

    public function showAlbum($albumId)
    {
        if ($user = SessionController::getUser()) {

            $albumsDao = new AlbumsDao();
            $imagesDao = new ImagesDao();

            if ($album = $albumsDao->getAlbum($albumId)) {
                if ($images = $imagesDao->getImages($album)) {
                    $album->setImages($images);
                }
            }

            if ($album->getFkUserId() != $user->getUserId()) {
                require_once '../../app/errors/page-404.html';
                exit();
            }

            $this->data->album = $album;
            $this->data->user = $user;

            require_once '../../app/albums/albums.php';
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }
}