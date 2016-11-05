<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:47
 */

include_once 'c:/xampp/htdocs/photoapp/db/dao/AlbumsDao.php';
include_once 'c:/xampp/htdocs/photoapp/db/dao/ImagesDao.php';
include_once 'c:/xampp/htdocs/photoapp/db/dao/UsersDao.php';
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

            require_once '../../app/albums/add.php';
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function loadEditAlbum($albumId)
    {
        if ($user = SessionController::getUser()) {
            $this->data->user = $user;

            $albumsDao = new AlbumsDao();
            if ($album = $albumsDao->getAlbum($albumId)) {
                if ($album->getAlbumId() == $user->getUserId()) {
                    $this->data->album = $album;
                    require_once '../../app/albums/edit.php';
                } else {
                    throw new Exception();
                }
            }

        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function viewAlbum($albumId)
    {
        if ($user = SessionController::getUser()) {

            $albumsDao = new AlbumsDao();
            $imagesDao = new ImagesDao();
            $usersDao = new UsersDao();

            if ($album = $albumsDao->getAlbum($albumId)) {
                if ($images = $imagesDao->getImagesByAlbum($album))
                    $album->setImages($images);
                if ($userAlbum = $usersDao->getUserByUserId($album->getUser()->getUserId()))
                    $album->setUser($userAlbum);
            }

            if ($user->getRole() != 1) {
                if ($album->getUser()->getRole() != $user->getRole()) {
                    throw new Exception();
                }
            }

            $this->data->album = $album;
            $this->data->user = $user;

            require_once '../../app/albums/albums.php';
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function createAlbum($albumName, $albumDescription)
    {
        if ($user = SessionController::getUser()) {
            $albumsDao = new AlbumsDao();
            $user = SessionController::getUser();

            if ($albumsDao->insertAlbum($albumName, $albumDescription, $user->getUserId())) {
                $this->data->error = false;
                $this->data->message = "Album created successfully";
            } else {
                $this->data->error = true;
                $this->data->message = $albumsDao->getResponse();
            }
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }

    }

    public function editAlbum($albumId, $albumName, $albumDescription)
    {
        if ($user = SessionController::getUser()) {
            $albumsDao = new AlbumsDao();

            if ($albumsDao->updateAlbum($albumId, $albumName, $albumDescription, $user->getUserId())) {
                $this->data->error = false;
                $this->data->message = "Album edited successfully";
            } else {
                $this->data->error = true;
                $this->data->message = $albumsDao->getResponse();
            }
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function deleteAlbum($albumId)
    {
        if ($user = SessionController::getUser()) {
            $albumsDao = new AlbumsDao();

            if ($albumsDao->deleteAlbum($albumId, $user->getUserId())) {
                RoutingController::redirect('http://localhost/photoapp/app/home');
            } else {
                throw new Exception();
            }
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

}