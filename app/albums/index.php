<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 4:49
 */

include_once '../../core/controllers/AlbumsController.php';

$albumController = new AlbumsController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $albumName = $_POST['album_name'];
    $albumDescription = $_POST['album_description'];

    $albumController->createAlbum($albumName, $albumDescription);
}

switch ($_GET["action"]) {
    case "add":
        $albumController->loadNewAlbum();
        break;
    case "show":
        if (isset($_GET["album-id"])) {
            $albumController->showAlbum($_GET["album-id"]);
        } else {
            require_once '../errors/page-404.html';
        }
        break;
    case "edit":
        echo "i equals 2";
        break;
    case "delete":
        echo "i equals 2";
        break;
    default:
        require_once '../errors/page-404.html';
        break;
}
