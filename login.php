<?php
include("functions.php");
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $errflag = false;

    // database connection
    $conn = openConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET CHARACTER SET utf8mb4");
    // new data

    $user = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password = sha1($password);

    // query
    $result = $conn->prepare('SELECT * FROM student WHERE username=? AND password=?');
    $result->execute(array($user, $password));
    $rows = $result->fetch(PDO::FETCH_NUM);
    if ($rows > 0) {
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        header("location: profile.php");
    } else {
        $msg = "<div class='card-panel teal darken-2'>User not found!</div>";
        $errflag = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
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
                    <li><a href="home.php">Home</a></li>
                    <li class="active"><a href="login.php">Log In</a></li>
                    <li><a href="index.php">Sign Up</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!--Form-->
    <div class="container">
        <h1>Log In</h1>
        <div class="row form">
            <?php echo $msg ?>
            <form class="col s12" method="post" action="login.php">

                <!-- USERNAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="username" name="username" type="text" class="validate" value="<?php echo $username ?>" required>
                        <label for="username">Username</label>
                    </div>
                </div>

                <!-- PASSWORD FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="password" type="password" class="validate" value="<?php echo $password ?>" required>
                        <label for="password">Password</label>
                    </div>
                </div>

                <!-- FORM SUBMIT BUTTON -->
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="submit">Login<i class="material-icons right">send</i></button>
                    </div>
                </div>
            </form>
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