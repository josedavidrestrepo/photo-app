<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/09/2016
 * Time: 18:50
 */

include_once 'c:/xampp/htdocs/photoapp/core/models/Image.php';

class ImagesOrm
{

    public static function mapImage($rowImage)
    {
        $image = new Image();

        $image->setImageId($rowImage["image_id"]);
        $image->setPhoto($rowImage["photo"]);
        $image->setDescription($rowImage["description"]);
        $image->setTittle($rowImage["tittle"]);
        $image->setComments($rowImage["comments"]);
        $image->setOrderNumber($rowImage['order_number']);

        return $image;
    }

}