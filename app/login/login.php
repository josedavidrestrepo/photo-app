<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 23:22
 */

include_once '../../core/views/LoginView.php';

$loginView = new LoginView($this->data);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../core/assets/css/normalize.css">
    <link rel="stylesheet" href="../../core/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/image-picker.css">


</head>

<body>

<div class="form">

    <ul class="tab-group">
        <li class="tab active"><a href="#login">Log In</a></li>
        <li class="tab"><a href="#signup">Sign Up</a></li>
    </ul>

    <div class="tab-content">

        <div id="login">
            <h1>Welcome Back!</h1>

            <form action="" method="post">

                <div class="field-wrap">
                    <label>
                        Username<span class="req">*</span>
                    </label>
                    <input name="username" type="text" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Password<span class="req">*</span>
                    </label>
                    <input name="password" type="password" required autocomplete="off"/>
                </div>

                <p class="forgot"><a href="#">Forgot Password?</a></p>

                <input name="action" type="hidden" value="login"/>

                <button class="button button-block">Log In</button>

                <p style="color: <?php echo $loginView->getData()->error ?  'red' : 'green' ?> "><?php $loginView->printMessage() ?></p>

            </form>

        </div>

        <div id="signup">
            <h1>Sign Up for Free</h1>

            <form action="" method="post">

                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                            First Name<span class="req">*</span>
                        </label>
                        <input name="firstName" type="text" required autocomplete="off"/>
                    </div>

                    <div class="field-wrap">
                        <label>
                            Last Name<span class="req">*</span>
                        </label>
                        <input name="lastName" type="text" required autocomplete="off"/>
                    </div>
                </div>

                <div class="field-wrap">
                    <label>
                        Username<span class="req">*</span>
                    </label>
                    <input name="username" type="text" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Set A Password<span class="req">*</span>
                    </label>
                    <input name="password" type="password" required autocomplete="off"/>
                </div>

                <input name="action" type="hidden" value="register"/>

                <button type="submit" class="button button-block">Get Started</button>

                <p style="color: <?php echo $loginView->getData()->error ?  'red' : 'green' ?> "><?php $loginView->printMessage() ?></p>

            </form>

        </div>

    </div><!-- tab-content -->

</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="../../core/assets/javascripts/index.js"></script>
<script src="assets/js/image-picker.js"></script>


</body>
</html>
