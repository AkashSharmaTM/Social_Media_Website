<?php
require 'session.php'; // Include the session management script
require 'db.php'; // Include the database connection

$user_id = $_SESSION['user_id'];

$query = $link->prepare("SELECT username, email, thumbnail FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->bind_result($username, $email, $thumbnail);
$query->fetch();

echo "<h3>Username: $username</h3>";
echo "<p>Email: $email</p>";
if ($thumbnail) {
    echo "<img src='$thumbnail' alt='Profile Picture' width='100'>";
} else {
    echo "<p>No profile picture uploaded.</p>";
}

$query->close();
$link->close();
?>
