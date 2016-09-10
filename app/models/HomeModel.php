<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 13:10
 */
class HomeModel
{
    private $user;

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

}