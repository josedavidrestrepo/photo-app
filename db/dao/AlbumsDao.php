<?php

/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 03/09/2016
 * Time: 23:54
 */
include_once 'c:/xampp/htdocs/photoapp/db/DbConnection.php';
include_once 'c:/xampp/htdocs/photoapp/db/orm/AlbumsOrm.php';

class AlbumsDao
{
    private $dbConnection;
    private $response;

    /**
     * AlbumsDao constructor.
     */
    public function __construct()
    {
        $this->dbConnection = new DbConnection();
    }

    function insertAlbum($albumName, $albumDescription, $user)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $sql = "INSERT INTO albums(name, description, fk_user_id) VALUES('$albumName', '$albumDescription', " . $user->getUserId() . ");";

            if ($this->dbConnection->link->query($sql)) {
                $response = true;
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $response;
    }

    public function updateAlbum($albumId, $albumName, $albumDescription)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $sql = "UPDATE albums SET name = '$albumName', description = '$albumDescription'WHERE album_id = '$albumId';";

            if ($this->dbConnection->link->query($sql)) {
                $response = true;
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $response;
    }

    public function deleteAlbum($idAlbum, $userId)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {
            $sql = "DELETE FROM albums WHERE album_id ='$idAlbum' AND fk_user_id = '$userId'";
            if ($this->dbConnection->link->query($sql)) {
                if ($this->dbConnection->link->affected_rows > 0)
                    $response = true;
                else
                    $response = false;
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $response;
    }

    public function getAlbums($user)
    {
        $albums = array();

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM albums WHERE fk_user_id = " . $user->getUserId();

            if ($result = $this->dbConnection->link->query($sql)) {
                while ($rowAlbum = $result->fetch_array(MYSQLI_ASSOC)) {
                    $album = AlbumsOrm::mapAlbum($rowAlbum);
                    array_push($albums, $album);
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $albums;
    }

    public function getAlbum($albumId)
    {
        $album = NULL;

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM albums WHERE album_id = '$albumId'";

            if ($result = $this->dbConnection->link->query($sql)) {
                if ($rowAlbum = $result->fetch_array(MYSQLI_ASSOC)) {
                    $album = AlbumsOrm::mapAlbum($rowAlbum);
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $album;
    }

    public function getOtherAlbums($user)
    {
        $albums = array();

        if ($this->dbConnection->dbConnect()) {

            $sql = $user->getRole() != 1 ? "SELECT * FROM albums INNER JOIN users ON user_id = albums.fk_user_id WHERE role = " . $user->getRole() . " AND user_id != " . $user->getUserId()
                : "SELECT * FROM albums INNER JOIN users ON user_id = albums.fk_user_id WHERE user_id != " . $user->getUserId();

            if ($result = $this->dbConnection->link->query($sql)) {
                while ($rowAlbum = $result->fetch_array(MYSQLI_ASSOC)) {
                    $album = AlbumsOrm::mapAlbum($rowAlbum);
                    array_push($albums, $album);
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $albums;
    }

    public function getResponse()
    {
        return $this->response;
    }
}