<?php

/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 03/09/2016
 * Time: 23:53
 */

include 'c:/xampp/htdocs/photoapp/db/DbConnection.php';

class UsersDao
{
    private $dbConnection;
    public $error;

    function UsersDao()
    {
        $this->dbConnection = new DbConnection();
    }
}