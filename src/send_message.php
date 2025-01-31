<?php
require 'session.php'; // Include the session management script
require 'db.php'; // Include the database connection

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];
$message = $_POST['message'];

$query = $link->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
$query->bind_param("iis", $user_id, $friend_id, $message);
$query->execute();

echo "Message sent.";

$query->close();
$link->close();
?>
