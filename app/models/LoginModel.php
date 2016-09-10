<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 14:04
 */
class LoginModel
{
    private $error;

    function __construct()
    {
        $this->error = "";
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

}