<?php
function openConnection()
{
    // Try to figure out what these should be for you
    $dbhost = "remotemysql.com";
    $dbuser = "33czP3G4ZR";
    $dbpass = "qNwQNP0iDI";
    $db = "33czP3G4ZR";

    // Try to understand what happens here
    $pdo = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);

    // Why we do this here
    return $pdo;
}

function secure_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
