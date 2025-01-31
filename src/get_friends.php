<?php
// Include session management
require 'session.php';
// Include database connection
require 'db.php';

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Query to select friends of the logged-in user
$query = $link->prepare("SELECT u.id, u.username FROM users u 
                         INNER JOIN friends f ON u.id = f.friend_id 
                         WHERE f.user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->bind_result($friend_id, $friend_username);

// Start building the dropdown menu options
$options = "<option value='' disabled selected>Select a friend</option>";
while ($query->fetch()) {
    $options .= "<option value='$friend_id'>$friend_username</option>";
}

// Close the query and database connection
$query->close();
$link->close();

// Output the dropdown menu options
echo $options;
?>
