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

if (isset($_GET["action"])) {
    if ($_GET["action"] == "add") {
        $albumController->loadNewAlbum();
    } else if ($_GET["action"] == "show") {
        if (isset($_GET["album-id"])) {
            $albumController->showAlbum($_GET["album-id"]);
        } else {
            require_once '../errors/page-404.html';
        }
    } else {
        require_once '../errors/page-404.html';
    }
} else {
    require_once '../errors/page-404.html';
}