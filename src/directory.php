<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, username, thumbnail FROM users WHERE id != $user_id";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Member Directory</title>
</head>
<body>
    <div class="directory-container">
        <h1>Member Directory</h1>
        <ul>
            <?php while ($user = mysqli_fetch_assoc($result)) {
                echo "<li><img src='../public/uploads/" . $user['thumbnail'] . "' alt='Profile Picture'> " . $user['username'] . " <button class='add-friend' data-id='" . $user['id'] . "'>Add Friend</button></li>";
            } ?>
        </ul>
        <a href="profile.php">Back to Profile</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/js/scripts.js"></script>
</body>
</html>

<?php
mysqli_close($link);
?>
