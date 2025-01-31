<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email, thumbnail FROM users WHERE id = $user_id";
$result = mysqli_query($link, $sql);
$user = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM friends WHERE user_id = $user_id";
$friends_result = mysqli_query($link, $sql);

$sql = "SELECT * FROM messages WHERE receiver_id = $user_id OR sender_id = $user_id ORDER BY timestamp DESC";
$messages_result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Profile</title>
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo $user['username']; ?></h1>
        <img src="../public/uploads/<?php echo $user['thumbnail']; ?>" alt="Profile Picture">
        <p>Email: <?php echo $user['email']; ?></p>
        <a href="logout.php">Logout</a>
    </div>
    <div class="profile-container">
        <h2>Friends</h2>
        <ul>
            <?php while ($friend = mysqli_fetch_assoc($friends_result)) {
                $friend_id = $friend['friend_id'];
                $friend_sql = "SELECT username, thumbnail FROM users WHERE id = $friend_id";
                $friend_result = mysqli_query($link, $friend_sql);
                $friend_user = mysqli_fetch_assoc($friend_result);
                echo "<li><img src='../public/uploads/" . $friend_user['thumbnail'] . "' alt='Profile Picture'> " . $friend_user['username'] . "</li>";
            } ?>
        </ul>
    </div>
    <div class="profile-container">
        <h2>Messages</h2>
        <ul>
            <?php while ($message = mysqli_fetch_assoc($messages_result)) {
                $sender_id = $message['sender_id'];
                $receiver_id = $message['receiver_id'];
                $sender_sql = "SELECT username FROM users WHERE id = $sender_id";
                $sender_result = mysqli_query($link, $sender_sql);
                $sender_user = mysqli_fetch_assoc($sender_result);

                $receiver_sql = "SELECT username FROM users WHERE id = $receiver_id";
                $receiver_result = mysqli_query($link, $receiver_sql);
                $receiver_user = mysqli_fetch_assoc($receiver_result);

                echo "<li><strong>" . $sender_user['username'] . " to " . $receiver_user['username'] . ":</strong> " . $message['content'] . "</li>";
            } ?>
        </ul>
    </div>
    <a href="directory.php">Find Friends</a>
</body>
</html>

<?php
mysqli_close($link);
?>
