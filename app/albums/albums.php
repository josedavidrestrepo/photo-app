<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/09/2016
 * Time: 3:30
 */

include_once '../../core/views/AlbumsView.php';

$albumView = new AlbumsView($this->data);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php $albumView->printAlbumName() ?></title>

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
            <a href="../home" class="brand-logo bold"><?php $albumView->printUserName() ?></a>
            <a class="btn-large waves-effect waves-light teal accent-4 tooltipped right" data-position="bottom"
               data-delay="50" data-tooltip="Logout" href="../login/index.php?action=logout">
                <i class="material-icons">exit_to_app</i>
            </a>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <h1 class="col s12 center-align"><?php $albumView->printAlbumName() ?></h1>
        <div class="center-align">
            <div class="separator bold">- - - - - - - <i class="material-icons">star</i> - - - - - - -</div>
        </div>
        <h4 class="col s12 center-align"><?php $albumView->printAlbumDescription() ?></h4>
    </div>
    <div class="row">
        <?php $albumView->printImages() ?>
        <div class="col s12 m6 l4 center-align btn-add-div">
            <a href="../images/?action=add&album-id=<?php $albumView->printAlbumId() ?>"
               class="btn-floating btn-large waves-effect waves-light red btn-add-a tooltipped hoverable"
               data-position="right" data-delay="50" data-tooltip="Add Image">
                <i class="material-icons btn-add-i">add</i>
            </a>
        </div>
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
