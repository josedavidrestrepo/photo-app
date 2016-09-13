<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 10/09/2016
 * Time: 23:22
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../core/assets/stylesheets/css/normalize.css">
    <link rel="stylesheet" href="../../core/assets/stylesheets/css/style.css">


</head>

<body>

<div class="form">


    <div id="login">
        <h1>Add a new album!</h1>

        <form action="" method="post">

            <div class="field-wrap">
                <label>
                    Name
                </label>
                <input name="username" type="text" required autocomplete="on"/>
            </div>
            <div class="field-wrap">
                <label>
                    Description
                </label>
                <input name="username" type="text" required autocomplete="on"/>
            </div>

            <input name="action" type="hidden" value="add"/>

            <button class="button button-block">Add</button>


        </form>
    </div>

</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="../../core/assets/javascripts/index.js"></script>


</body>
</html>
