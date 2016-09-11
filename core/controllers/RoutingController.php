<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/09/2016
 * Time: 0:02
 */
class RoutingController
{
    public static function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}