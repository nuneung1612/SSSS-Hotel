<?php
$servername = "database-hotel.c3g80xkhlr8y.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = getenv('Pass');

try {
    $db = new PDO("mysql:host=$servername;dbname=HotelDB", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
