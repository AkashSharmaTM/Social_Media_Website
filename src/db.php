<?php

$host = 'localhost';
$db = 'social_network';
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

$link = new mysqli($host, $user, $pass, $db);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

try {
    $db = new PDO('mysql:host=localhost;dbname=social_network', 'root', ''); // Adjust as needed
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
