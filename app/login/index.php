<?php

include_once '../../core/controllers/LoginController.php';

$loginController = new LoginController();

if (isset($_GET["action"]) && $_GET["action"] == "logout")
{
    $loginController->logout();
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($action == "register")
    {
        $name = $_POST['firstName'] . ' ' . $_POST['lastName'];
        $avatar = "prueba.jpg";

        $loginController->register($name, $username, $password, $avatar);
    }
    else if ($action == "login")
    {
        $loginController->login($username, $password);
    }
}

$loginController->load();
