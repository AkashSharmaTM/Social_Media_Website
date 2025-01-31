<?php
require 'session.php';
require 'db.php';

$user_id = $_SESSION['user_id'];
$friend_id = $_GET['friend_id'];

$query = $link->prepare("SELECT m.content, u.username, m.sender_id FROM private_messages m 
                         JOIN users u ON m.sender_id = u.id 
                         WHERE (m.sender_id = ? AND m.receiver_id = ?) 
                            OR (m.sender_id = ? AND m.receiver_id = ?) 
                         ORDER BY m.timestamp ASC");
$query->bind_param("iiii", $user_id, $friend_id, $friend_id, $user_id);
$query->execute();
$query->bind_result($content, $username, $sender_id);

while ($query->fetch()) {
    $alignment = $sender_id == $user_id ? 'align-right' : 'align-left';
    echo "<div class='message $alignment'><strong>$username:</strong> $content</div>";
}

$query->close();
$link->close();
?>
