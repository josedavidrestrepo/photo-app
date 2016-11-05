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

    public function printAlbumName()
    {
        if (isset($this->data->album)) {
            echo $this->data->album->getName();
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

    public function printAlbumDescription()
    {
        if (isset($this->data->album)) {
            echo $this->data->album->getDescription();
        }
    }

    public function printImages()
    {
        $album = $this->data->album;
        $images = (array)$album->getImages();

        foreach ($images as $image) {
            echo /** @lang HTML */
                '<div class="col s12 m6 l4">
                    <div class="card small hoverable sticky-action">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="/photoapp/photos/' . $image->getPhoto() . '">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">' . $image->getTittle() . '
                                <i class="material-icons right">keyboard_arrow_up</i>                            
                            </span>
                             
                        </div>
                        <div class="card-action">
                           <div class="row center-align">
                                <a class="btn teal accent-4 tooltipped" href="../images/?action=show&image-id=' . $image->getImageId() . ' " 
                                    data-position="bottom" data-delay="50" data-tooltip="Show image">
                                    <i class="material-icons">search</i>
                                </a>
                                <a class="btn teal accent-4 tooltipped" href="../images/?action=edit&image-id=' . $image->getImageId() . '&album-id=' . $album->getAlbumId() . '"
                                    data-position="bottom" data-delay="50" data-tooltip="Edit image">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a class="btn teal accent-4 tooltipped" href="../images/?action=delete&image-id=' . $image->getImageId() . '&album-id=' . $album->getAlbumId() . '"
                                    data-position="bottom" data-delay="50" data-tooltip="Delete image">
                                    <i class="material-icons">delete</i>
                                </a>
                             </div>  
                            <div class="center-align">
                                <a class="btn-floating btn waves-effect waves-light blue-grey darken-4 tooltipped" 
                                    data-position="top" data-delay="50" data-tooltip="Up" href="../images/index.php?action=up&image-id=' . $image->getImageId() . '&album-id=' . $album->getAlbumId() . '">
                                    <i class="material-icons">arrow_upward</i>
                                </a>
                                <a class="btn-floating btn waves-effect waves-light blue-grey darken-4 tooltipped"
                                    data-position="top" data-delay="50" data-tooltip="Down" href="../images/index.php?action=down&image-id=' . $image->getImageId() . '&album-id=' . $album->getAlbumId() . '">
                                    <i class="material-icons">arrow_downward</i>
                                </a>
                            </div>  
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">' . $image->getTittle() . '
                                <i class="material-icons right">keyboard_arrow_down</i>
                            </span>
                            <p>' . $image->getDescription() . '</p>
                            <p>' . $image->getComments() . '</p>
                        </div>
                    </div>
                </div>';
        }
    }

    public function printAlbumId()
    {
        if (isset($this->data->album)) {
            echo $this->data->album->getAlbumId();
        }
    }
}