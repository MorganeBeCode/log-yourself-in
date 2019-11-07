<?php
session_start();
include("functions.php");

$msg = "";
$username = $password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
        $username = secure_input($_POST["username"]);
        $email = secure_input($_POST["email"]);
        $password = secure_input($_POST["password"]);
        $password = sha1($password);
    }

    try {
        $pdo = openConnection();

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        $sql = "INSERT INTO student (username, email, password) VALUES ('$username', '$email', '$password')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $msg = "<div class='card-panel teal darken-2'>Your account has been successfully created. Please <a href='login.php'>log in</a> in order to access your profile.</div>";
        $pdo = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

function secure_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
                    <li><a class="active" href="index.php">Sign Up</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!--Form-->
    <div class="container">
        <h1>Sign Up</h1>
        <div class="row form">
            <?php echo $msg ?>
            <form class="col s12" method="post" action="index.php">

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

                <!-- EMAIL FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate" value="<?php echo $email ?>" required>
                        <label for="email">Email</label>
                    </div>
                </div>

                <!-- FORM SUBMIT BUTTON -->
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="submit">Create account<i class="material-icons right">send</i></button>
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