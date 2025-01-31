<?php
require 'session.php';
require 'db.php';

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];
$message = $_POST['message'];

$query = $link->prepare("INSERT INTO private_messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
$query->bind_param("iis", $user_id, $friend_id, $message);

if ($query->execute()) {
    echo "Private message sent.";
} else {
    echo "Error sending private message.";
}

$query->close();
$link->close();
?>
