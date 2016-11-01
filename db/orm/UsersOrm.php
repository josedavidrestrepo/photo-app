<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/09/2016
 * Time: 1:23
 */
include_once 'c:/xampp/htdocs/photoapp/core/models/User.php';
include_once 'c:/xampp/htdocs/photoapp/core/models/Person.php';

class UsersOrm
{

    public static function mapUser($rowUser)
    {
        $person = new Person();

        $person->setPersonId("person_id");
        $person->setName($rowUser["name"]);

        $user = new User();

        $user->setUserId($rowUser["user_id"]);
        $user->setUsername($rowUser["username"]);
        $user->setPassword($rowUser["password"]);
        $user->setAvatar($rowUser["avatar"]);
        $user->setRole($rowUser["role"]);

        $user->setPerson($person);

        return $user;
    }
}