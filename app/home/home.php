<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/09/2016
 * Time: 0:29
 */
include_once '../../core/views/HomeView.php';

$homeView = new HomeView($this->data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

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
<body id="page-top" class="scrollspy">

<div class="navbar-fixed">
    <nav class="blue-grey darken-4">
        <div class="nav-wrapper blue-grey darken-4 container">
            <a href="#page-top" class="brand-logo bold"><?php $homeView->printUserName() ?></a>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <a class="btn-large waves-effect waves-light teal accent-4 tooltipped right" data-position="bottom"
               data-delay="50" data-tooltip="Logout" href="../login/index.php?action=logout">
                <i class="material-icons">exit_to_app</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="bold" href="#albums"><i class="material-icons left">collections</i>ALBUMS</a></li>
                <li><a class="bold" href="#about"><i class="material-icons left">extension</i>ABOUT</a></li>
                <li><a class="bold" href="#contact"><i class="material-icons left">contact_mail</i>CONTACT</a></li>
            </ul>
            <ul id="mobile-menu" class="side-nav">
                <li><a class="bold" href="#albums"><i class="material-icons">collections</i>ALBUMS</a></li>
                <li><a class="bold" href="#about"><i class="material-icons">extension</i>ABOUT</a></li>
                <li><a class="bold" href="#contact"><i class="material-icons">contact_mail</i>CONTACT</a></li>
            </ul>
        </div>
    </nav>
</div>

<section id="profile" class=" teal accent-4 section-custom scrollspy">
    <div class="row container center-align">
        <div class="s12">
            <img class="img-responsive" src="../../core/assets/images/home/profile.png" alt="">
            <div class="white-text">
                <span class="intro-text"><?php $homeView->printName() ?></span>
                <div class="separator">- - - - - - - <i class="material-icons">star</i> - - - - - - -</div>
                <span class="skills">Web Developer - Graphic Artist - User Experience Designer</span>
            </div>
        </div>
    </div>
</section>

<section id="albums" class="section-custom scrollspy">
    <div class="container">
        <div class="row center-align">
            <h3 class="bold">ALBUMS</h3>
            <div class="separator bold">- - - - - - - <i class="material-icons">star</i> - - - - - - -</div>
        </div>
        <div class="row">
            <?php $homeView->printAlbums() ?>
            <div class="col s12 m6 l4 center-align btn-add-div">
                <a class="btn-floating btn-large waves-effect waves-light red btn-add-a tooltipped hoverable"
                   data-position="right"
                   data-delay="50" data-tooltip="Add album"><i class="material-icons btn-add-i">add</i></a>
            </div>
        </div>
    </div>
</section>

<section id="about" class="scrollspy">

</section>

<section id="contact" class="scrollspy">

</section>


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
        $(".button-collapse").sideNav();
        $('.scrollspy').scrollSpy();
    });
</script>

</body>
</html>