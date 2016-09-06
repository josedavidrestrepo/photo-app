<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 06/09/2016
 * Time: 3:00
 */
class Login
{
    private $message;

    public function __construct()
    {
        $this->message = "";
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

}