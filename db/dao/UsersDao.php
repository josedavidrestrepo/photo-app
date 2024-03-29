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

    function insertUser($name, $username, $password, $avatar, $role)
    {
        $response = false;

        if ($this->dbConnection->dbConnect()) {

            $name = $this->dbConnection->link->real_escape_string($name);
            $username = $this->dbConnection->link->real_escape_string($username);
            $password = $this->dbConnection->link->real_escape_string($password);
            $avatar = $this->dbConnection->link->real_escape_string($avatar);
            $role = $this->dbConnection->link->real_escape_string($role);

            $sql1 = "INSERT INTO persons(name) VALUES('$name')";

            if ($this->dbConnection->link->query($sql1)) {
                $last_id = $this->dbConnection->link->insert_id;
                $sql2 = "INSERT INTO users(username, password, avatar, fk_person_id, role) VALUES('$username', '$password', '$avatar','$last_id','$role');";

                if ($this->dbConnection->link->query($sql2)) {
                    $response = true;
                } else {
                    $this->response = $this->dbConnection->link->error;
                }
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
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

    function getUserByUserName($username)
    {
        $user = NULL;

        if ($this->dbConnection->dbConnect()) {

            $username = $this->dbConnection->link->real_escape_string($username);

            $sql = "SELECT * FROM users INNER JOIN persons ON person_id = fk_person_id WHERE username = '$username' ";

            if ($result = $this->dbConnection->link->query($sql)) {
                if ($result->num_rows == 1) {
                    if ($rowUser = $result->fetch_array(MYSQLI_ASSOC)) {
                        $user = UsersOrm::mapUser($rowUser);
                    }
                } else {
                    $this->response = "Your username or password is invalid";
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $user;
    }

    function getUserByUserId($userId)
    {
        $user = NULL;

        if ($this->dbConnection->dbConnect()) {

            $userId = $this->dbConnection->link->real_escape_string($userId);

            $sql = "SELECT * FROM users INNER JOIN persons ON person_id = fk_person_id WHERE user_id = '$userId' ";

            if ($result = $this->dbConnection->link->query($sql)) {
                if ($result->num_rows == 1) {
                    if ($rowUser = $result->fetch_array(MYSQLI_ASSOC)) {
                        $user = UsersOrm::mapUser($rowUser);
                    }
                } else {
                    $this->response = "Your username or password is invalid";
                }

                $result->free_result();
            } else {
                $this->response = $this->dbConnection->link->error;
            }

            $this->dbConnection->link->close();
        } else {
            $this->response = $this->dbConnection->error;
        }

        return $user;
    }

    public function getResponse()
    {
        return $this->response;
    }


}