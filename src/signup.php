<?php
require 'db.php'; // Include the database connection

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$thumbnail = '';

if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($_FILES['thumbnail']['name']);
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadFile)) {
        $thumbnail = $uploadFile;
    }
}

$query = $link->prepare("INSERT INTO users (username, email, password, thumbnail) VALUES (?, ?, ?, ?)");
$query->bind_param("ssss", $username, $email, $password, $thumbnail);

if ($query->execute()) {
    echo "Signup successful. You can now <a href='../public/login.html'>login</a>.";
} else {
    echo "Signup failed. Please try again.";
}

$query->close();
$link->close();
?>
