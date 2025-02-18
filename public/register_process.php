<?php
session_start();

// Database connection settings
$databaseFile = 'users.db';

try {
    $pdo = new PDO("sqlite:$databaseFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ensure the users table exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        email TEXT UNIQUE NOT NULL,
        phone TEXT NOT NULL,
        password TEXT NOT NULL,
        profile_picture TEXT DEFAULT NULL
    )");
} catch (PDOException $e) {
    $_SESSION['error'] = "Database connection failed: " . $e->getMessage();
    header("Location: register.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim and sanitize user inputs
    $inputUsername = trim(htmlspecialchars($_POST['username']));
    $inputEmail = trim(htmlspecialchars($_POST['email']));
    $inputPhone = trim(htmlspecialchars($_POST['phone']));
    $inputPassword = $_POST['password'];
    $inputConfirmPassword = $_POST['confirm_password'];
    $profilePicture = null;

    // Check if passwords match
    if ($inputPassword !== $inputConfirmPassword) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: register.php");
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

    // Handle Profile Picture Upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error'] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            header("Location: register.php");
            exit;
        }

        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $profilePicture = $uploadDir . uniqid() . "_" . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture);
    }

    try {
        // Check if the username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $inputUsername, PDO::PARAM_STR);
        $stmt->bindParam(':email', $inputEmail, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['error'] = "Username or email already exists!";
            header("Location: register.php");
            exit;
        }

        // Insert new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, password, profile_picture) VALUES (:username, :email, :phone, :password, :profile_picture)");
        $stmt->bindParam(':username', $inputUsername, PDO::PARAM_STR);
        $stmt->bindParam(':email', $inputEmail, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $inputPhone, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':profile_picture', $profilePicture, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Successful registration
            $_SESSION['success'] = [
                'username' => $inputUsername,
                'email' => $inputEmail
            ];
            header("Location: register.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: register.php");
        exit;
    }
}
?>
