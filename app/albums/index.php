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

if (isset($_GET["action"]) && $_GET["action"] == "new-album") {
    $albumController->loadNewAlbum();
} else {
    require_once '../errors/page-404.html';
}