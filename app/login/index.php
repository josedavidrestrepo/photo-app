<?php

include_once '../../core/controllers/LoginController.php';

$loginController = new LoginController();

try {
    if (isset($_GET["action"]) && $_GET["action"] == "logout") {
        $loginController->logout();
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST['action'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($action == "register") {
            $name = $_POST['firstName'] . ' ' . $_POST['lastName'];
            $avatar = "prueba.jpg";
            $role = $_POST['role'];

            $loginController->register($name, $username, $password, $avatar, $role);
        } else if ($action == "login") {
            $loginController->login($username, $password);
        }
    }

    $loginController->load();

} catch (Exception $e) {
    require_once '../errors/page-404.html';
}
