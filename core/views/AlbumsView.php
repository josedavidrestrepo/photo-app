<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 06/09/2016
 * Time: 17:01
 */
class AlbumsView
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
}