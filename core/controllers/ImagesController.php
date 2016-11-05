<?php

/**
 * Created by PhpStorm.
 * User: wdosp
 * Date: 03/09/2016
 * Time: 20:50
 */

include_once 'c:/xampp/htdocs/photoapp/db/dao/ImagesDao.php';
include_once 'c:/xampp/htdocs/photoapp/db/dao/AlbumsDao.php';
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
            $this->data->user = $user;
            $imagesDao = new ImagesDao();
            if ($images = $imagesDao->getImagesByUser($user->getUserId(), $albumId))
                $this->data->images = $images;
            require_once '../../app/images/add.php';
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    public function loadEditImage($imageId, $albumId)
    {
        if ($user = SessionController::getUser()) {
            $this->data->user = $user;

            $imagesDao = new ImagesDao();
            if ($this->verifyOwner($albumId, $user)) {
                if ($image = $imagesDao->getImage($imageId, $albumId)) {
                    $this->data->image = $image;
                    $this->data->albumId = $albumId;
                    require_once '../../app/images/edit.php';
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    private function verifyOwner($albumId, $user)
    {
        $albumsDao = new AlbumsDao();
        if ($album = $albumsDao->getAlbum($albumId)) {
            if ($album->getUser()->getUserId() == $user->getUserId()) {
                return true;
            }
        }

        return false;
    }

    public function createImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $albumId)
    {
        if ($user = SessionController::getUser()) {
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
                    $this->data->message = "Couldn't get order number";
                }
            } else {
                $this->data->error = true;
                $this->data->message = "Couldn't upload image";
            }
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    public function editImage($imageTittle, $imageDescription, $imageComments, $imageId, $albumId)
    {
        if ($user = SessionController::getUser()) {
            $imagesDao = new ImagesDao();
            if ($this->verifyOwner($albumId, $user)) {
                if ($imagesDao->updateImage($imageTittle, $imageDescription, $imageComments, $imageId)) {
                    $this->data->error = false;
                    $this->data->message = "Image edited successfully";
                } else {
                    $this->data->error = true;
                    $this->data->message = $imagesDao->getResponse();
                }
            } else {
                throw new Exception();
            }
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    public function deleteImage($imageId, $albumId)
    {
        if ($user = SessionController::getUser()) {
            $this->data->user = $user;

            $imagesDao = new ImagesDao();
            if ($this->verifyOwner($albumId, $user)) {
                if ($imagesDao->deleteImage($imageId, $albumId)) {
                    RoutingController::redirect('/photoapp/app/albums/?action=view&album-id=' . $albumId);
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }

        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    public function linkImage($albumId, $imageLinkId)
    {
        if ($user = SessionController::getUser()) {
            $imagesDao = new ImagesDao();
            if ($this->verifyOwner($albumId, $user)) {
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
            } else {
                throw new Exception();
            }
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    public function upImage($albumId, $imageId)
    {
        if ($user = SessionController::getUser()) {
            $imagesDao = new ImagesDao();
            if ($this->verifyOwner($albumId, $user)) {
                if ($previousImage = $imagesDao->getPreviousImage($albumId, $imageId)) {
                    if ($image = $imagesDao->getImage($imageId, $albumId)) {
                        if ($imagesDao->updateOrderImage($albumId, $image->getImageId(), -1) &&
                            $imagesDao->updateOrderImage($albumId, $previousImage->getImageId(), $image->getOrderNumber()) &&
                            $imagesDao->updateOrderImage($albumId, $image->getImageId(), $previousImage->getOrderNumber())
                        ) {
                            RoutingController::redirect('/photoapp/app/albums/?action=view&album-id=' . $albumId);
                        } else {
                            throw new Exception();
                        }
                    } else {
                        throw new Exception();
                    }
                } else {
                    RoutingController::redirect('/photoapp/app/albums/?action=view&album-id=' . $albumId);
                }
            } else {
                throw new Exception();
            }
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

    public function downImage($albumId, $imageId)
    {
        if ($user = SessionController::getUser()) {

            $imagesDao = new ImagesDao();
            if ($this->verifyOwner($albumId, $user)) {
                if ($nextImage = $imagesDao->getNextImage($albumId, $imageId)) {
                    if ($image = $imagesDao->getImage($imageId, $albumId)) {
                        if ($imagesDao->updateOrderImage($albumId, $image->getImageId(), -1) &&
                            $imagesDao->updateOrderImage($albumId, $nextImage->getImageId(), $image->getOrderNumber()) &&
                            $imagesDao->updateOrderImage($albumId, $image->getImageId(), $nextImage->getOrderNumber())
                        ) {
                            RoutingController::redirect('/photoapp/app/albums/?action=view&album-id=' . $albumId);
                        } else {
                            throw new Exception();
                        }
                    } else {
                        throw new Exception();
                    }
                } else {
                    RoutingController::redirect('/photoapp/app/albums/?action=view&album-id=' . $albumId);
                }
            } else {
                throw new Exception();
            }
        } else {
            RoutingController::redirect('/photoapp');
        }
    }

}