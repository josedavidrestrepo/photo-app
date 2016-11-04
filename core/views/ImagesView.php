<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 06/09/2016
 * Time: 17:02
 */
class ImagesView
{
    private $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    public function printUserName()
    {
        if (isset($this->data->user)) {
            echo $this->data->user->getUserName();
        }
    }

    public function getColor()
    {
        echo $this->data->error ? 'red' : 'green';
    }

    public function printMessage()
    {
        echo $this->data->message;
    }

    public function printImagePhoto()
    {
        if (isset($this->data->user)) {
            echo $this->data->image->getPhoto();
        }
    }

    public function printImageTittle()
    {
        if (isset($this->data->user)) {
            echo $this->data->image->getTittle();
        }
    }

    public function printImageDescription()
    {
        if (isset($this->data->user)) {
            echo $this->data->image->getDescription();
        }
    }

    public function printImageOptions()
    {
        if (isset($this->data->user)) {
            foreach ($this->data->images as $image) {
                echo /** @lang HTML */
                    '<option value=" ' . $image->getImageId() . '">' . $image->getTittle() . '</option>';
            }

        }
    }

    public function printImageComments()
    {
        if (isset($this->data->user)) {
            echo $this->data->image->getComments();
        }
    }
}