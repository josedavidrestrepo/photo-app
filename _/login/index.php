<?php

include_once '../../app/controllers/LoginController.php';
include_once '../../app/models/LoginModel.php';
include_once '../../app/views/LoginView.php';

$loginModel = new LoginModel();
$loginController = new LoginController($loginModel);
$loginView = new LoginView($loginModel);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginController->login($username, $password);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto+Slab'>
    <script src="../assets/js/prefixfree.min.js"></script>

</head>
<body>
<div class='preload login--container'>

    <form id="formSearchUpdateShipping" action="" method="POST">
        <div class='login--username-container'>
            <label>Username</label>
            <input name="username" autofocus placeholder='Username' type='text'>
        </div>
        <div class='login--password-container'>
            <label>Password</label>
            <input name="password" placeholder='Password' type='password'>
            <button type="submit" class='js-toggle-login login--login-submit'>Login</button>
        </div>
    </form>
    <div class='login--toggle-container'>
        <small>Hey you,</small>
        <div class='js-toggle-login'>Login</div>
        <small>already</small>
    </div>
    <div>
        <p><?php $loginView->printError() ?></p>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../assets/js/index.js"></script>
</body>
</html>