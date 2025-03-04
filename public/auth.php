<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password and set session
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];  // Store user ID in session
        $_SESSION['username'] = $user['username']; // Store username
        $_SESSION['login_status'] = "success"; // Indicate login success
    } else {
        $_SESSION['login_status'] = "failed"; // Indicate login failure
    }

    header("Location: index.php"); // Redirect back to login for pop-up message
    exit;
}
