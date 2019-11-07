<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!--Favicon-->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!--Stylesheets-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <!--Header-->
    <header>
        <nav id="header-nav">
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a class="active" href="home.php">Home</a></li>
                    <?php
                    if (isset($_SESSION["username"])) {
                        ?>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php
                    } else {
                        ?>
                        <li><a href="login.php">Log In</a></li>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_SESSION["username"])) {
                        ?>
                        <li><a href="profile.php">My Profile</a></li>
                    <?php
                    } else {
                        ?>
                        <li><a href="index.php">Sign Up</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <!--Main-->
    <div class="container">
        <div class="row">
            <div class="col s12 center-align">
                <h3>This page is under construction... </h3>
                <h3>In the meantime, here's a octopus gif.</h3>
                <img class="responsive-img" src="cute_monster.gif" alt="octopus">
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer class="page-footer">
        <div class="row">
            <div class="col s4">
                <p>© 2019 Octopus Incorporate</p>
                <p>Icons made by <a href="https://www.flaticon.com/authors/freepik" target="_blank" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" target="_blank" title="Flaticon">www.flaticon.com</a></p>
            </div>
            <div class="col s1 offset-s6">
                <a class="grey-text text-lighten-3" href="https://github.com/MorganeBecode" target="_blank" title="Morgane's Github">
                    <img class="responsive-img icons" src="octopus.png" alt="octopus icon">
                </a>
            </div>
            <div class="col s1">
                <a class="grey-text text-lighten-3" href="https://github.com/D-Ermis" target="_blank" title="Dogukan's Github">
                    <img class="responsive-img icons" src="raven.png" alt="raven icon">
                </a>
            </div>
        </div>
    </footer>

</body>

</html>