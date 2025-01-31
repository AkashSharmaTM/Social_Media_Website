<?php
require 'session.php'; // Include session management
require 'db.php'; // Include database connection

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];

$query = $link->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?, ?)");
$query->bind_param("ii", $user_id, $friend_id);

if ($query->execute()) {
    echo "Friend request sent.";
} else {
    echo "Error sending friend request.";
}

$query->close();
$link->close();
?>
