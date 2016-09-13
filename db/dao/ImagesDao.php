<?php

/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 03/09/2016
 * Time: 23:55
 */

include_once 'c:/xampp/htdocs/photoapp/db/DbConnection.php';
include_once 'c:/xampp/htdocs/photoapp/db/orm/ImagesOrm.php';

class ImagesDao
{
    private $dbConnection;
    private $response;

    /**
     * ImagesDao constructor.
     */
    public function __construct()
    {
        $this->dbConnection = new DbConnection();
    }

    public function getFirstImage($album)
    {
        $images = array();

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM images_x_album ia INNER JOIN images i ON i.image_id = ia.fk_image_id WHERE ia.fk_album_id = " . $album->getAlbumId() . " LIMIT 1";

            if ($result = $this->dbConnection->link->query($sql)) {
                while ($rowImage = $result->fetch_array(MYSQLI_ASSOC)) {
                    $image = ImagesOrm::mapImage($rowImage);
                    array_push($images, $image);
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $images;
    }

    public function getImages($album)
    {
        $images = array();

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM images_x_album ia INNER JOIN images i ON i.image_id = ia.fk_image_id WHERE ia.fk_album_id = " . $album->getAlbumId();

            if ($result = $this->dbConnection->link->query($sql)) {
                while ($rowImage = $result->fetch_array(MYSQLI_ASSOC)) {
                    $image = ImagesOrm::mapImage($rowImage);
                    array_push($images, $image);
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $images;
    }

}