<?php

$username = $password = $email = "";

$dbhost = "remotemysql.com";
$dbuser = "33czP3G4ZR";
$dbpass = "qNwQNP0iDI";
$db = "33czP3G4ZR";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
        $username = secure_input($_POST["username"]);
        $email = secure_input($_POST["email"]);
        $password = secure_input($_POST["password"]);
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    try {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        $sql = "INSERT INTO student (username, email, password) VALUES ('$username', '$email', '$password')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        foreach ($pdo->query('SELECT * from student') as $row) {
            echo $row["username"];
        }

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
