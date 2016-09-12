<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 06/09/2016
 * Time: 0:53
 */
class DbConnection
{
    public $link;
    public $error;

    private $hostName = "127.0.0.1";
    private $databaseName = "photoapp";
    private $userName = "root";
    private $password = "";

    /**
     * @return bool
     */
    function dbConnect()
    {
        $this->link = @mysqli_connect($this->hostName, $this->userName, $this->password, $this->databaseName);

        if (!$this->link)
        {
            $this->error = @mysqli_connect_error();
            return false;
        }
        else
            return true;
    }

    function dbDisconnect()
    {
        $this->link = NULL;
    }
}