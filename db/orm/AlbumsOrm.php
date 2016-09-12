<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/09/2016
 * Time: 17:42
 */

include_once 'c:/xampp/htdocs/photoapp/core/models/Album.php';

class AlbumsOrm
{

    public static function mapAlbum($rowAlbum)
    {
        $album = new Album();

        $album->setAlbumId($rowAlbum["album_id"]);
        $album->setName($rowAlbum["name"]);
        $album->setDescription($rowAlbum["description"]);

        return $album;
    }
}