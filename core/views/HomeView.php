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
        if (isset($user)) {
            echo $user->getUserName();
        }
    }

    public function printName()
    {
        $user = $this->data->user;
        if (isset($user)) {
            echo $user->getName();
        }
    }

    public function printAlbums()
    {
        $albums = (array)$this->data->user->getAlbums();

        foreach ($albums as $album) {
            echo /** @lang HTML */
                '<div class="col s12 m6 l4">' .
                '<div class="card hoverable sticky-action">' .
                '<div class="card-image waves-effect waves-block waves-light">' .
                '<img class="activator" src=' . $this->getImageUrl($album) . '>' .
                '</div>' .
                '<div class="card-content">' .
                '<span class="card-title activator grey-text text-darken-4">' . $album->getName() . '<i class="material-icons right">keyboard_arrow_up</i></span>' .
                '<p class="center-align"><a class="btn teal accent-4" href="#"><i class="material-icons">search</i></a></p>' .
                '</div>' .
                '<div class="card-reveal">' .
                '<span class="card-title grey-text text-darken-4">' . $album->getName() . '<i class="material-icons right">keyboard_arrow_down</i></span>' .
                '<p>' . $album->getDescription() . '</p>' .
                '</div>' .
                '</div>' .
                '</div>';
        }
    }

    private function getImageUrl($album)
    {
        if ($images = $album->getImages()) {
            $image = $images[0]->getPhoto();
        } else {
            $image = "../../core/assets/images/home/portfolio/submarine.png";
        }

        return $image;
    }

}