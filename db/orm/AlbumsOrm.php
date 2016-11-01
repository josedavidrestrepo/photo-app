<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/09/2016
 * Time: 17:42
 */

include_once 'c:/xampp/htdocs/photoapp/core/models/Album.php';
include_once 'c:/xampp/htdocs/photoapp/core/models/User.php';

class AlbumsOrm
{

    public static function mapAlbum($rowAlbum)
    {
        $album = new Album();

        $album->setAlbumId($rowAlbum["album_id"]);
        $album->setName($rowAlbum["name"]);
        $album->setDescription($rowAlbum["description"]);

        $user = new User();
        $user->setUserId($rowAlbum["fk_user_id"]);

        $album->setUser($user);

        return $album;
    }
}