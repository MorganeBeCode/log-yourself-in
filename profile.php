<?php
session_start();
$username = $password = $email = $lastname = $firstname = $linkedin = $github = "";

$dbhost = "remotemysql.com";
$dbuser = "33czP3G4ZR";
$dbpass = "qNwQNP0iDI";
$db = "33czP3G4ZR";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);

    $data = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    $result = $conn->prepare('SELECT * FROM student WHERE username=:u AND password=:p');
    $result->bindParam(':u', $_SESSION['username']);
    $result->bindParam(':p', $_SESSION['password']);
    $result->execute();
    $rows = $result->fetch(PDO::FETCH_NUM);

    foreach ($conn->query("SELECT * FROM student WHERE username= '" . $_SESSION['username'] . "' AND password= '" . $_SESSION['password'] . "'") as $row) {
        $_SESSION["lastname"] = $row["lastname"];
        $_SESSION["firstname"] = $row["firstname"];
        $_SESSION["linkedin"] = $row["linkedin"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["github"] = $row["github"];
    }
    $lastname = secure_input($_POST["lastname"]);
    $firstname = secure_input($_POST["firstname"]);
    $email = secure_input($_POST["email"]);
    $password = secure_input($_POST["password"]);
    $username = secure_input($_POST["username"]);
    $linkedin = secure_input($_POST["linkedin"]);
    $github = secure_input($_POST["github"]);

    $pdo = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function secure_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);

        $result = $conn->prepare("UPDATE student 
                                  SET lastname =:ln, firstname =:fn, email=:e, github=:g, linkedin=:li
                                  WHERE username=:u AND password=:p");
        $result->bindParam(':u', $_SESSION['username']);
        $result->bindParam(':ln', $lastname);
        $result->bindParam(':fn', $firstname);
        $result->bindParam(':e', $email);
        $result->bindParam(':g', $github);
        $result->bindParam(':li', $linkedin);
        $result->bindParam(':p', $_SESSION['password']);
        $result->execute();
        $rows = $result->fetch(PDO::FETCH_NUM);
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["linkedin"] = $linkedin;
        $_SESSION["github"] = $github;
        $pdo = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
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
                    <li><a href="profile.php">My Profile</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!--Form-->
    <div class="container">
        <h1>My Profile</h1>
        <h2>Welcome <?php echo $_SESSION["firstname"]; ?></h2>
        <div class="row form">
            <form class="col s12" method="post" action="profile.php">

                <!-- USERNAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="username" name="username" type="text" class="validate" value="<?php echo $_SESSION['username'] ?>" required>
                        <label for="username">Username</label>
                    </div>
                </div>

                <!-- PASSWORD FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="password" type="password" class="validate" value="<?php echo $_SESSION['password'] ?>" required>
                        <label for="password">Password</label>
                    </div>
                </div>

                <!-- EMAIL FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate" value="<?php echo $_SESSION["email"] ?>" required>
                        <label for="email">Email</label>
                    </div>
                </div>

                <!-- LAST NAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="lastname" name="lastname" type="text" class="validate" value="<?php echo $_SESSION["lastname"] ?>">
                        <label for="lastname">Last Name</label>
                    </div>
                </div>

                <!-- FIRST NAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="firstname" name="firstname" type="text" class="validate" value="<?php echo $_SESSION["firstname"] ?>">
                        <label for="firstname">First Name</label>
                    </div>
                </div>

                <!-- LINKEDIN FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="linkedin" name="linkedin" type="text" class="validate" value="<?php echo $_SESSION["linkedin"] ?>">
                        <label for="linkedin">Linkedin</label>
                    </div>
                </div>

                <!-- LINKEDIN FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="github" name="github" type="text" class="validate" value="<?php echo $_SESSION["github"] ?>">
                        <label for="github">Github</label>
                    </div>
                </div>

                <!-- FORM SUBMIT BUTTON -->
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="submit">Submit<i class="material-icons right">send</i></button>
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