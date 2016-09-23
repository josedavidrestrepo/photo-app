<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/09/2016
 * Time: 4:05
 */

include_once '../../core/controllers/ImagesController.php';

$imageController = new ImagesController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePhoto = $_POST['image_photo'];
    $imageTittle = $_POST['image_tittle'];
    $imageDescription = $_POST['image_description'];
    $imageComments = $_POST['image_comments'];


    if (isset($_GET["action"])) {
        if ($_GET["action"] == "add") {
            if (isset($_GET["album-id"])) {
                $albumId = $_GET["album-id"];
            } else {
                throw new Exception("");
            }
            $imageController->createImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $albumId);
        } else if ($_GET["action"] == "edit") {
            if (isset($_GET["image-id"])) {
                $imageId = $_GET["image-id"];
            } else {
                throw new Exception("");
            }
            $imageController->editImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $imageId);
        }
    }


}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "add") {
        $imageController->loadNewImage();
    } else if ($_GET["action"] == "edit") {
        if (isset($_GET["image-id"])) {
            $imageId = $_GET["image-id"];
            $imageController->loadEditImage($imageId);
        } else {
            require_once '../errors/page-404.html';
        }
    }
} else {
    require_once '../errors/page-404.html';
}