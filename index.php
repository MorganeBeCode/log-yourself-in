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
</head>

<body>
    <div class="container">
        <div class="row">
            <form class="col s12" action="" method="post">

                <!-- USERNAME FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">Username</label>
                    </div>
                </div>

                <!-- PASSWORD FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>

                <!-- EMAIL FIELD -->
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate">
                        <label for="email">Email</label>
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

<?php

$dbhost = "database";
$dbuser = "root";
$dbpass = "root";
$db = "becode";

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);

    foreach ($pdo->query('SELECT * from student') as $row) {
        echo '<pre>';
        print_r($row);
        echo '</pre>';
    }
    $pdo = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>