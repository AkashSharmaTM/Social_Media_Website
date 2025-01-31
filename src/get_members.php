<?php
require 'session.php'; // Include session management
require 'db.php'; // Include database connection

$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = $link->prepare("SELECT id, username, email FROM users WHERE username LIKE ?");
$search = "%$search%";
$query->bind_param("s", $search);
$query->execute();
$query->bind_result($id, $username, $email);

while ($query->fetch()) {
    echo "<div class='member'>
            <p>$username ($email)</p>
            <button class='addFriend' data-id='$id'>Add Friend</button>
          </div>";
}

$query->close();
$link->close();
?>
<script>
$(document).ready(function() {
    $('.addFriend').click(function() {
        var friendId = $(this).data('id');
        $.post('../src/add_friend.php', { friend_id: friendId }, function(response) {
            alert(response);
        });
    });
});
</script>
