<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 4:49
 */

include_once '../../core/controllers/AlbumsController.php';

$albumController = new AlbumsController();

try {

    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        switch ($action) {
            case "view":
            case "edit":
            case "delete":
                if (isset($_GET["album-id"]))
                    $albumId = $_GET["album-id"];
                else
                    throw new Exception();
                break;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $albumName = $_POST['album_name'];
        $albumDescription = $_POST['album_description'];

        switch ($action) {
            case "add":
                $albumController->createAlbum($albumName, $albumDescription);
                break;
            case "edit":
                $albumController->editAlbum($albumId, $albumName, $albumDescription);
                break;
            default:
                throw new Exception();
        }

    }

    switch ($action) {
        case "view":
            $albumController->viewAlbum($albumId);
            break;
        case "add":
            $albumController->loadNewAlbum();
            break;
        case "edit":
            $albumController->loadEditAlbum($albumId);
            break;
        case "delete":
            $albumController->deleteAlbum($albumId);
            break;
        default:
            throw new Exception();
    }

} catch (Exception $e) {
    require_once '../errors/page-404.html';
}
