<?php
require 'session.php'; // Include the session management script
require 'db.php'; // Include the database connection

$user_id = $_SESSION['user_id'];
$friend_id = $_GET['friend_id'];

$query = $link->prepare("SELECT m.*, u.username FROM messages m
                         JOIN users u ON m.sender_id = u.id
                         WHERE (m.sender_id = ? AND m.receiver_id = ?)
                            OR (m.sender_id = ? AND m.receiver_id = ?)
                         ORDER BY m.timestamp ASC");
$query->bind_param("iiii", $user_id, $friend_id, $friend_id, $user_id);
$query->execute();
$result = $query->get_result();

while ($message = $result->fetch_assoc()) {
    $alignment = $message['sender_id'] == $user_id ? 'align-right' : 'align-left';
    echo "<div class='message $alignment'>{$message['username']}: {$message['content']}</div>";
}

$query->close();
$link->close();
?>
