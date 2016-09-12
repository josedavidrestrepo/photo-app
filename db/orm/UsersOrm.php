<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/09/2016
 * Time: 1:23
 */
include_once 'c:/xampp/htdocs/photoapp/core/models/User.php';

class UsersOrm
{

    public static function mapUser($rowUser)
    {
        $user = new User();

        $user->setUserId($rowUser["user_id"]);
        $user->setUsername($rowUser["username"]);
        $user->setPassword($rowUser["password"]);
        $user->setName($rowUser["name"]);
        $user->setAvatar($rowUser["avatar"]);

        return $user;
    }
}