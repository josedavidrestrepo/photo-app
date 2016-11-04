<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/09/2016
 * Time: 4:05
 */

include_once '../../core/controllers/ImagesController.php';

$imageController = new ImagesController();

try {
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        switch ($action) {
            case "add":
                if (isset($_GET["album-id"]))
                    $albumId = $_GET["album-id"];
                else
                    throw new Exception();
                break;
            case "edit":
                if (isset($_GET["image-id"]))
                    $imageId = $_GET["image-id"];
                else
                    throw new Exception();
                break;
            case "delete":
                if (isset($_GET["image-id"]) && isset($_GET["album-id"])) {
                    $imageId = $_GET["image-id"];
                    $albumId = $_GET["album-id"];
                } else
                    throw new Exception();
                break;
            default:
                throw new Exception();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $imageTittle = $_POST['image_tittle'];
        $imageDescription = $_POST['image_description'];
        $imageComments = $_POST['image_comments'];

        switch ($action) {
            case "add":
                $imageController->createImage('image_photo', $imageTittle, $imageDescription, $imageComments, $albumId);
                break;
            case "edit":
                $imageController->editImage($imageTittle, $imageDescription, $imageComments, $imageId);
                break;
            default:
                throw new Exception();
        }
    }

    switch ($action) {
        case "add":
            $imageController->loadNewImage($albumId);
            break;
        case "edit":
            $imageController->loadEditImage($imageId);
            break;
        case "delete":
            $imageController->deleteImage($imageId, $albumId);
            break;
        default:
            throw new Exception();
    }

} catch (Exception $e) {
    require_once '../errors/page-404.html';
}
