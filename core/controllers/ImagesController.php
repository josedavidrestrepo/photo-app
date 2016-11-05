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
            if ($images = $imagesDao->getImagesByUser($user, $albumId))
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

            if ($orderNumber = $imagesDao->getLastOrder($albumId)) {
                if ($imagesDao->insertImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $orderNumber, $albumId)) {
                    $this->data->error = false;
                    $this->data->message = "Image created successfully";
                } else {
                    $this->data->error = true;
                    $this->data->message = $imagesDao->getResponse();
                }
            } else {
                $this->data->error = true;
                $this->data->message = "Couldn't find order number";
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

    public function linkImage($albumId, $imageLinkId)
    {
        $imagesDao = new ImagesDao();

        if ($orderNumber = $imagesDao->getLastOrder($albumId)) {
            if ($imagesDao->linkImage($albumId, $imageLinkId, $orderNumber)) {
                $this->data->error = false;
                $this->data->message = "Image linked successfully";
            } else {
                $this->data->error = true;
                $this->data->message = $imagesDao->getResponse();
            }
        } else {
            $this->data->error = true;
            $this->data->message = "Couldn't find order number";
        }

    }

    public function upImage($albumId, $imageId)
    {
        if ($user = SessionController::getUser()) {
            $imagesDao = new ImagesDao();
            if ($previousImage = $imagesDao->getPreviousImage($albumId, $imageId)) {
                if ($image = $imagesDao->getImage($imageId)) {
                    if ($imagesDao->updateOrderImage($albumId, $image->getImageId(), -1) &&
                        $imagesDao->updateOrderImage($albumId, $previousImage->getImageId(), $image->getOrderNumber()) &&
                        $imagesDao->updateOrderImage($albumId, $image->getImageId(), $previousImage->getOrderNumber())
                    ) {
                        require_once '../../app/home/index.php';
                    } else {
                        require_once '../../app/errors/page-404.html';
                    }
                } else {
                    require_once '../../app/errors/page-404.html';
                }
            } else {
                require_once '../../app/home/index.php';
            }
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

    public function downImage($albumId, $imageId)
    {
        if ($user = SessionController::getUser()) {

            $imagesDao = new ImagesDao();

            if ($nextImage = $imagesDao->getNextImage($albumId, $imageId)) {
                if ($image = $imagesDao->getImage($imageId)) {
                    if ($imagesDao->updateOrderImage($albumId, $image->getImageId(), -1) &&
                        $imagesDao->updateOrderImage($albumId, $nextImage->getImageId(), $image->getOrderNumber()) &&
                        $imagesDao->updateOrderImage($albumId, $image->getImageId(), $nextImage->getOrderNumber())
                    ) {
                        require_once '../../app/home/index.php';
                    } else {
                        require_once '../../app/errors/page-404.html';
                    }
                } else {
                    require_once '../../app/errors/page-404.html';
                }
            } else {
                require_once '../../app/home/index.php';
            }
        } else {
            RoutingController::redirect('http://localhost/photoapp');
        }
    }

}