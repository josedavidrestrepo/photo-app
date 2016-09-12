<?php

/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 03/09/2016
 * Time: 23:53
 */

include_once 'c:/xampp/htdocs/photoapp/db/DbConnection.php';
include_once 'c:/xampp/htdocs/photoapp/db/orm/UsersOrm.php';

class UsersDao
{
    private $dbConnection;
    private $response;

    function UsersDao()
    {
        $this->dbConnection = new DbConnection();
    }

    function insertUser($name, $username, $password, $avatar)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $sql = "INSERT INTO users(name, username, password, avatar) VALUES('$name', '$username', '$password', '$avatar');";

            if ($this->dbConnection->link->query( $sql)) {
                $response = true;
            }
            else
            {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        }
        else
        {
            $this->response = $this->dbConnection->error;
        }

        return $response;
    }

    function updateUser($user_id, $name, $username, $password, $avatar)
    {

    }

    function deleteUser($user_id)
    {

    }

    function getUser($username, $password){

        $user = NULL;

        if ($this->dbConnection->dbConnect()) {

            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

            if ($result = $this->dbConnection->link->query( $sql)) {
                if ($result->num_rows == 1)
                {
                    if ($rowUser = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        $user = UsersOrm::mapUser($rowUser);
                    }
                }
                else
                {
                    $this->response = "Your username or password is invalid";
                }

                $result->free_result();
            }
            else
            {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        }
        else
        {
            $this->response = $this->dbConnection->error;
        }

        return $user;
    }

    public function getResponse()
    {
        return $this->response;
    }
}