<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/09/2016
 * Time: 17:27
 */
class Album
{
    private $album_id;
    private $name;
    private $description;
    private $fkUserId;

    private $images;

    /**
     * @return mixed
     */
    public function getAlbumId()
    {
        return $this->album_id;
    }

    /**
     * @param mixed $album_id
     */
    public function setAlbumId($album_id)
    {
        $this->album_id = $album_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getFkUserId()
    {
        return $this->fkUserId;
    }

    /**
     * @param mixed $fkUserId
     */
    public function setFkUserId($fkUserId)
    {
        $this->fkUserId = $fkUserId;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }
}