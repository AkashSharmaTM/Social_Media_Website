<?php
session_start();
require 'db.php'; // Include the database connection

$username = $_POST['username'];
$password = $_POST['password'];

$query = $link->prepare("SELECT id, password FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$query->store_result();

if ($query->num_rows > 0) {
    $query->bind_result($user_id, $hashed_password);
    $query->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: ../public/dashboard.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Invalid username or password.";
}

$query->close();
$link->close();
?>
