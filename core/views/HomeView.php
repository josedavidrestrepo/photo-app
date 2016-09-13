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
            echo '<div class="col-sm-4 portfolio-item">
                    <a href="../../app/albums?id=' . $album->getAlbumId() . '" class="portfolio-link">
                        <div class="caption" style="margin-bottom: 15px;">
                            <div class="caption-content" style="text-align: center; ">
                                <i class="fa fa-search-plus fa-3x" style="font-size: 2em;"> ' . $album->getName() . '</i>
                            </div>
                        </div>
                        
                        <img src= ' . $this->getImageUrl($album) . ' class="img-responsive" alt="">
                    </a>
                </div>';


        }

    }

    private function getImageUrl($album)
    {
        if ($images = $album->getImages()) {
            $image = $images[0]->getPhoto();
        } else {
            $image = "../../core/assets/images/home/portfolio/cabin.png";
        }

        return $image;
    }

}