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

    public function getImage($imageId, $albumId)
    {
        $image = NULL;

        if ($this->dbConnection->dbConnect()) {

            $imageId = $this->dbConnection->link->real_escape_string($imageId);
            $albumId = $this->dbConnection->link->real_escape_string($albumId);

            $sql = "SELECT * FROM images_x_album ia INNER JOIN images i ON i.image_id = ia.fk_image_id WHERE image_id = '$imageId' AND fk_album_id = '$albumId'";

            if ($result = $this->dbConnection->link->query($sql)) {
                if ($rowImage = $result->fetch_array(MYSQLI_ASSOC)) {
                    $image = ImagesOrm::mapImage($rowImage);
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $image;
    }

    public function insertImage($imagePhoto, $imageTittle, $imageDescription, $imageComments, $orderNumber, $albumId)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $imagePhoto = $this->dbConnection->link->real_escape_string($imagePhoto);
            $imageTittle = $this->dbConnection->link->real_escape_string($imageTittle);
            $imageDescription = $this->dbConnection->link->real_escape_string($imageDescription);
            $imageComments = $this->dbConnection->link->real_escape_string($imageComments);
            $orderNumber = $this->dbConnection->link->real_escape_string($orderNumber);
            $albumId = $this->dbConnection->link->real_escape_string($albumId);

            $sql1 = "INSERT INTO images(photo, tittle, description, comments) VALUES('$imagePhoto', '$imageTittle', '$imageDescription', '$imageComments');";

            if ($this->dbConnection->link->query($sql1)) {
                $last_id = $this->dbConnection->link->insert_id;
                $sql2 = "INSERT INTO images_x_album(fk_image_id, fk_album_id,order_number) VALUES('$last_id', '$albumId','$orderNumber');";

                if ($this->dbConnection->link->query($sql2)) {
                    $response = true;
                } else {
                    $this->response = $this->dbConnection->link->error;
                }

            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $response;
    }

    public function updateImage($imageTittle, $imageDescription, $imageComments, $imageId)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $imageTittle = $this->dbConnection->link->real_escape_string($imageTittle);
            $imageDescription = $this->dbConnection->link->real_escape_string($imageDescription);
            $imageComments = $this->dbConnection->link->real_escape_string($imageComments);
            $imageId = $this->dbConnection->link->real_escape_string($imageId);

            $sql = "UPDATE images SET tittle = '$imageTittle', description = '$imageDescription', comments = '$imageComments' WHERE image_id = '$imageId';";

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

    public function updateOrderImage($albumId, $imageId, $order_number)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $albumId = $this->dbConnection->link->real_escape_string($albumId);
            $imageId = $this->dbConnection->link->real_escape_string($imageId);
            $order_number = $this->dbConnection->link->real_escape_string($order_number);

            $sql = "UPDATE images_x_album SET order_number = '$order_number' WHERE fk_image_id = '$imageId' AND fk_album_id = '$albumId'";

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

    public function deleteImage($imageId, $albumId)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $imageId = $this->dbConnection->link->real_escape_string($imageId);
            $albumId = $this->dbConnection->link->real_escape_string($albumId);

            $sql = "DELETE FROM images_x_album WHERE fk_image_id = '$imageId' AND fk_album_id = '$albumId';";
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

    public function linkImage($albumId, $imageLinkId, $orderNumber)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $albumId = $this->dbConnection->link->real_escape_string($albumId);
            $imageLinkId = $this->dbConnection->link->real_escape_string($imageLinkId);
            $orderNumber = $this->dbConnection->link->real_escape_string($orderNumber);

            $sql = "INSERT INTO images_x_album(fk_album_id, fk_image_id, order_number) VALUES ('$albumId','$imageLinkId','$orderNumber')";

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

    public function getFirstImage($album)
    {
        $images = array();

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM images_x_album ia INNER JOIN images i ON i.image_id = ia.fk_image_id WHERE ia.fk_album_id = " . $album->getAlbumId() . " ORDER BY order_number LIMIT 1";

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

    public function getImagesByAlbum($album)
    {
        $images = array();

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM images_x_album ia INNER JOIN images i ON i.image_id = ia.fk_image_id WHERE ia.fk_album_id = " . $album->getAlbumId() . " ORDER BY order_number";

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

    public function getImagesByUser($userId, $albumId)
    {
        $images = array();

        if ($this->dbConnection->dbConnect()) {

            $albumId = $this->dbConnection->link->real_escape_string($albumId);

            $sql = "SELECT * FROM images_x_album ia INNER JOIN images i ON i.image_id = ia.fk_image_id INNER JOIN albums a ON a.album_id = ia.fk_album_id WHERE a.fk_user_id = '$userId' AND a.album_id != '$albumId' AND NOT EXISTS (SELECT 1 FROM images_x_album ia2 WHERE ia2.fk_image_id = i.image_id AND ia2.fk_album_id = '$albumId' ) ORDER BY order_number";

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

    public function getLastOrder($albumId)
    {
        $orderNumber = 1;

        if ($this->dbConnection->dbConnect()) {

            $albumId = $this->dbConnection->link->real_escape_string($albumId);

            $sql = "SELECT * FROM images_x_album WHERE fk_album_id = '$albumId' ORDER BY order_number DESC LIMIT 1";

            if ($result = $this->dbConnection->link->query($sql)) {
                if ($result->num_rows != 0) {
                    $rowOrder = $result->fetch_array(MYSQLI_ASSOC);
                    $orderNumber = $rowOrder["order_number"] + 1;
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $orderNumber;
    }

    public function getPreviousImage($albumId, $imageId)
    {
        $image = NULL;
        if ($this->dbConnection->dbConnect()) {

            $albumId = $this->dbConnection->link->real_escape_string($albumId);
            $imageId = $this->dbConnection->link->real_escape_string($imageId);

            $sql = "SELECT *
                    FROM images_x_album ia
                    INNER JOIN images i ON i.image_id = ia.fk_image_id
                    WHERE fk_album_id = '$albumId' AND order_number < (SELECT order_number FROM images_x_album WHERE fk_image_id = '$imageId' AND fk_album_id = '$albumId')
                    ORDER BY order_number DESC
                    LIMIT 1";
            if ($result = $this->dbConnection->link->query($sql)) {
                if ($rowImage = $result->fetch_array(MYSQLI_ASSOC)) {
                    $image = ImagesOrm::mapImage($rowImage);
                }
                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }
            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }
        return $image;
    }


    public function getNextImage($albumId, $imageId)
    {
        $image = NULL;

        if ($this->dbConnection->dbConnect()) {

            $albumId = $this->dbConnection->link->real_escape_string($albumId);
            $imageId = $this->dbConnection->link->real_escape_string($imageId);

            $sql = "SELECT  *
                    FROM images_x_album ia
                    INNER JOIN images i ON i.image_id = ia.fk_image_id
                    WHERE fk_album_id = '$albumId' AND order_number > (SELECT order_number FROM images_x_album WHERE fk_image_id = '$imageId' AND fk_album_id = '$albumId')
                    ORDER BY order_number
                    LIMIT 1";

            if ($result = $this->dbConnection->link->query($sql)) {
                if ($rowImage = $result->fetch_array(MYSQLI_ASSOC)) {
                    $image = ImagesOrm::mapImage($rowImage);
                }
                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }
            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }
        return $image;
    }


    public function getResponse()
    {
        return $this->response;
    }

}