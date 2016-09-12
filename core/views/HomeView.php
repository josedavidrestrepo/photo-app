<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 13:10
 */
class HomeView
{
    private $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    public function printUserName()
    {
        $user = $this->data->user;
        if (isset($user))
        {
            echo $user->getUserName();
        }
    }

    public function printName()
    {
        $user = $this->data->user;
        if (isset($user))
        {
            echo $user->getName();
        }
    }

    public function printAlbums()
    {

        $albums = (array)$this->data->user->getAlbums();

        foreach ($albums as $album) {
            echo '<p>' . $album->getName() . '</p>';
        }

    }

}