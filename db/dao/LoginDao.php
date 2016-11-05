<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 06/09/2016
 * Time: 3:29
 */

include 'c:/xampp/htdocs/photoapp/core/db/DbConnection.php';

class LoginDao
{
    public $error;
    private $dbConnection;

    function LoginDao()
    {
        $this->dbConnection = new DbConnection();
    }

    function validateUser($username, $password)
    {
        if ($this->dbConnection->dbConnect()) {

            $username = $this->dbConnection->link->real_escape_string($username);
            $password = $this->dbConnection->link->real_escape_string($password);

            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

            if ($result = mysqli_query($this->dbConnection->connectionString, $sql)) {
                $count = mysqli_num_rows($result);

                mysqli_free_result($result);
                mysqli_close($this->dbConnection->connectionString);

                if ($count == 1) {
                    return true;
                } else {
                    $this->error = "Your Login Name or Password is invalid";
                    return false;
                }
            } else {
                $this->error = $this->dbConnection->error;
                mysqli_close($this->dbConnection->connectionString);
                return false;
            }
        } else {
            $this->error = $this->dbConnection->error;
            return false;
        }
    }
}