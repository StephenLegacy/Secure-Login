<?php
// Start the session to check user authentication
session_start();
require 'db.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details including profile picture
$user_id = $_SESSION['user_id'];
$query = "SELECT username, profile_picture FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Default values
$username = htmlspecialchars($user["username"] ?? "Guest");
$profile_picture = !empty($user["profile_picture"]) ? $user["profile_picture"] : "default.jpg"; // Default image

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Dashboard</title>
    <link rel="stylesheet" href="/assets/portal.css">

</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <div class="profile-container">
                
                <h1>Welcome, <span id="user-name"><?php echo $username; ?></span></h1>
            </div>
        </header>
        <section class="content">
            <div class="cards">
                <div class="card">
                    <h3>Statistics</h3>
                    <p>Analytics data and reports</p>
                </div>
                <div class="card">
                    <h3>Recent Activities</h3>
                    <p>Activity feed and updates</p>
                </div>
                <div class="card">
                    <h3>Messages</h3>
                    <p>View your inbox</p>
                </div>
            </div>
        </section>
    </div>

</body>
</html>
