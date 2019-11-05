<?php
session_start();
$username = $password = $email = $lastname = $firstname = $linkedin = $github = "";

$dbhost = "remotemysql.com";
$dbuser = "33czP3G4ZR";
$dbpass = "qNwQNP0iDI";
$db = "33czP3G4ZR";

$username = secure_input($_POST["username"]);
$lastname = secure_input($_POST["last_name"]);
$email = secure_input($_POST["email"]);
$password = secure_input($_POST["password"]);
$password = password_hash($password, PASSWORD_DEFAULT);

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
        $lastname = $row["last_name"];
        $firstname = $row["first_name"];
        $linkedin = $row["linkedin"];
        $email = $row["email"];
        $github = $row["github"];
    }
    $lastname = secure_input($_POST["last_name"]);
    $firstname = secure_input($_POST["first_name"]);
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
                                  SET last_name =:ln, first_name =:fn, email=:e, github=:g, linkedin=:li
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
    <title>Log yourself in</title>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="login.php">Log In</a></li>
                    <li><a class="active" href="index.php">Sign In</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!--Form-->
    <div class="container">
        <h1>My Profile</h1>
        <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
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
                        <input id="email" name="email" type="email" class="validate" value="<?php echo $email ?>" required>
                        <label for="email">Email</label>
                    </div>
                </div>

                <!-- LAST NAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo $lastname ?>" required>
                        <label for="last_name">Last Name</label>
                    </div>
                </div>

                <!-- FIRST NAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo $firstname ?>" required>
                        <label for="first_name">First Name</label>
                    </div>
                </div>

                <!-- LINKEDIN FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="linkedin" name="linkedin" type="text" class="validate" value="<?php echo $linkedin ?>" required>
                        <label for="linkedin">Linkedin</label>
                    </div>
                </div>

                <!-- LINKEDIN FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="github" name="github" type="text" class="validate" value="<?php echo $github ?>" required>
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
</body>

</html>