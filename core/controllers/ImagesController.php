<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:50
 */

include_once 'c:/xampp/htdocs/photoapp/db/dao/ImagesDao.php';
include_once 'SessionController.php';
include_once 'RoutingController.php';
include_once 'UploadController.php';

class ImagesController
{
    private $data;

    function __construct()
    {
        $this->data = new stdClass();
        $this->data->error = false;
        $this->data->message = "";
    }

    public function loadNewImage($albumId)
    {
        if ($user = SessionController::getUser()) {
            $imagesDao = new ImagesDao();
            if ($images = $imagesDao->getImagesUser($user, $albumId))
                $this->data->images = $images;
            $this->data->user = $user;
            require_once '../../app/images/add.php';
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function loadEditImage($imageId)
    {
        if ($user = SessionController::getUser()) {
            $this->data->user = $user;

            $imagesDao = new ImagesDao();
            if ($image = $imagesDao->getImage($imageId)) {
                $this->data->image = $image;
                require_once '../../app/images/edit.php';
            }

        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function createImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $albumId)
    {
        if ($imagePhoto = UploadController::uploadImage($imagePhoto)) {
            $imagesDao = new ImagesDao();

            if ($imagesDao->insertImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $albumId)) {
                $this->data->error = false;
                $this->data->message = "Image created successfully";
            } else {
                $this->data->error = true;
                $this->data->message = $imagesDao->getResponse();
            }
        } else {
            $this->data->error = true;
            $this->data->message = "Couldn't upload image";
        }
    }

    public function editImage($imageTittle, $imageDescription, $imageComments, $imageId)
    {
        $imagesDao = new ImagesDao();

        if ($imagesDao->updateImage($imageTittle, $imageDescription, $imageComments, $imageId)) {
            $this->data->error = false;
            $this->data->message = "Image edited successfully";
        } else {
            $this->data->error = true;
            $this->data->message = $imagesDao->getResponse();
        }
    }

    public function deleteImage($imageId, $albumId)
    {
        if ($user = SessionController::getUser()) {
            $imagesDao = new ImagesDao();

            if ($imagesDao->deleteImage($imageId, $albumId)) {
                require_once '../../app/home/index.php';
            } else {
                require_once '../../app/errors/page-404.html';
            }
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

}