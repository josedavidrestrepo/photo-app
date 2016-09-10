<?php

/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 03/09/2016
 * Time: 23:53
 */

include 'c:/xampp/htdocs/photoapp/app/db/DbConnection.php';
include 'c:/xampp/htdocs/photoapp/app/entities/User.php';

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

            if ($result = mysqli_query($this->dbConnection->link, $sql)) {
                if ($result->num_rows == 1)
                {
                    if ($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        $user = new User();

                        $user->setUserId($row["user_id"]);
                        $user->setUsername($row["username"]);
                        $user->setPassword($row["password"]);
                        $user->setName($row["name"]);
                        $user->setAvatar($row["avatar"]);
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

            mysqli_close($this->dbConnection->link);
        }
        else
        {
            $this->response = $this->dbConnection->error;
            print $this->dbConnection->error;
        }

        return $user;
    }

    public function getResponse()
    {
        return $this->response;
    }
}