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
include_once 'c:/xampp/htdocs/photoapp/db/dao/ImagesDao.php';

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
            $imagesDao = new ImagesDao();

            if ($albums = $albumsDao->getAlbums($user)) {

                foreach ($albums as $album) {
                    if ($images = $imagesDao->getFirstImage($album)) {
                        $album->setImages($images);
                    }
                }

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