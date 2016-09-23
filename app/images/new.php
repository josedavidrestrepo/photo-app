<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/09/2016
 * Time: 23:47
 */

include_once '../../core/views/ImagesView.php';

$imageView = new ImagesView($this->data);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Image</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../core/assets/stylesheets/css/materialize.min.css"
          media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../../core/assets/stylesheets/css/styles.css"
          media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<div class="navbar-fixed">
    <nav class="blue-grey darken-4">
        <div class="nav-wrapper blue-grey darken-4 container">
            <a href="../home" class="brand-logo bold"><?php $imageView->printUserName() ?></a>
            <a class="btn-large waves-effect waves-light teal accent-4 tooltipped right" data-position="bottom"
               data-delay="50" data-tooltip="Logout" href="../login/index.php?action=logout">
                <i class="material-icons">exit_to_app</i>
            </a>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <h1 class="col s12 center-align">Add a new image!</h1>
        <div class="center-align">
            <div class="separator bold">- - - - - - - <i class="material-icons">star</i> - - - - - - -</div>
        </div>
        <form action="" method="post" class="col s12">
            <div class="row">
                <div class="file-field input-field col s12">
                    <i class="material-icons prefix">file_upload</i>
                    <input id="image_photo" name="image_photo" type="url" class="validate" length="767">
                    <label for="image_photo">Photo</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">photo_album</i>
                    <input id="image_tittle" name="image_tittle" type="text" class="validate" length="50">
                    <label for="image_tittle">Tittle</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="image_description" name="image_description" class="materialize-textarea"
                              length="200"></textarea>
                    <label for="image_description">Description</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">comment</i>
                    <textarea id="image_comments" name="image_comments" class="materialize-textarea"
                              length="100"></textarea>
                    <label for="image_comments">Comments</label>
                </div>
                <div class="input-field col s12 center-align ">
                    <button class="btn-large waves-effect waves-light teal accent-4">Create
                        <i class="material-icons right">note_add</i>
                    </button>
                </div>
                <div class="input-field col s12">
                    <p class="center-align"
                       style="color: <?php $imageView->getColor() ?> "><?php $imageView->printMessage() ?></p>
                </div>
            </div>
        </form>
    </div>
</div>

<footer class="page-footer blue-grey darken-4">
    <div class="row">
        <div class="col l6 s12">
            <h5 class="white-text">Footer Content</h5>
            <p class="grey-text">You can use rows and columns here to organize your footer content.</p>
        </div>
        <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Links</h5>
            <ul>
                <li><a class="grey-text " href="#!">Link 1</a></li>
                <li><a class="grey-text " href="#!">Link 2</a></li>
                <li><a class="grey-text " href="#!">Link 3</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-copyright blue-grey darken-3 ">
        <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../core/assets/javascripts/js/materialize.min.js"></script>

<script>
    $(document).ready(function () {
    });
</script>

</body>
</html>