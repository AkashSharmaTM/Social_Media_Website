<?php
require 'session.php';
require 'db.php';

$query = $link->prepare("SELECT m.content, u.username FROM public_messages m JOIN users u ON m.user_id = u.id ORDER BY m.timestamp DESC");
$query->execute();
$query->bind_result($content, $username);

while ($query->fetch()) {
    echo "<div class='message'><strong>$username:</strong> $content</div>";
}

$query->close();
$link->close();
?>
