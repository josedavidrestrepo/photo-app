<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 06/09/2016
 * Time: 0:53
 */
class DbConnection
{
    public $connectionString;
    public $error;

    private $hostName = "127.0.0.1";
    private $databaseName = "photoapp";
    private $userName = "root";
    private $password = "";

    function dbConnect()
    {
        $this->connectionString = @mysqli_connect($this -> hostName,$this -> userName,$this -> password,$this->databaseName);

        if (!$this->connectionString)
        {
            $this->error = mysqli_connect_error();
            return false;
        }
        else
            return true;
    }

    function dbDisconnect()
    {
        $this->connectionString = NULL;
    }
}