<?php
require 'session.php';
require 'db.php';

$user_id = $_SESSION['user_id'];
$message = $_POST['message'];

$query = $link->prepare("INSERT INTO public_messages (user_id, content) VALUES (?, ?)");
$query->bind_param("is", $user_id, $message);

if ($query->execute()) {
    echo "Public message posted.";
} else {
    echo "Error posting public message.";
}

$query->close();
$link->close();
?>
