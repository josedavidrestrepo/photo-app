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

class ImagesController
{
    private $data;

    function __construct()
    {
        $this->data = new stdClass();
        $this->data->error = false;
        $this->data->message = "";
    }

    public function loadNewImage()
    {
        if ($user = SessionController::getUser()) {
            $this->data->user = $user;

            require_once '../../app/images/new.php';
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
        $imagesDao = new ImagesDao();

        if ($imagesDao->insertImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $albumId)) {
            $this->data->error = false;
            $this->data->message = "Image created successfully";
        } else {
            $this->data->error = true;
            $this->data->message = $imagesDao->getResponse();
        }
    }

    public function editImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $imageId)
    {
        $imagesDao = new ImagesDao();

        if ($imagesDao->updateImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $imageId)) {
            $this->data->error = false;
            $this->data->message = "Image edited successfully";
        } else {
            $this->data->error = true;
            $this->data->message = $imagesDao->getResponse();
        }
    }


}