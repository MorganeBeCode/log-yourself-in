<?php

function openConnection()
{
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

    return $pdo;
}

openConnection();
