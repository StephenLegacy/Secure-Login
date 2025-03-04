<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/assets/styles.css"> <!-- Make sure the path is correct -->
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="contact-container">
        <h1>Register a New Account</h1>

        <div class="contact-form">
            <h2>Create your account</h2>

            <!-- Registration form -->
            <form id="registerForm" action="register_process.php" method="post" enctype="multipart/form-data">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter a unique username" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password (8+ characters)" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>

                <label for="profile_picture">Profile Picture (Optional)</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">

                <button type="submit">Register</button>
                <<button id="backToLogin" type="button">Log In</button>

                <script>
                    document.getElementById("backToLogin").addEventListener("click", function() {
                        window.location.href = "login.php";
                    });
                </script>

            </form>
        </div>

        <!-- <div class="contact-info">
            <div class="info-box">
                <i class="fas fa-map-marker-alt"></i>
                <p>Standard Street, Nairobi, Kenya</p>
            </div>
            <div class="info-box">
                <i class="fas fa-phone"></i>
                <p>+254 716 631 667</p>
            </div>
            <div class="info-box">
                <i class="fas fa-envelope"></i>
                <p>info@securelogin.com</p>
            </div>
        </div>
    </div> -->

    <footer>
        <!-- Footer content -->
    </footer>

<?php    
    // Check if session has a success message
if (isset($_SESSION['success'])) {
    $username = $_SESSION['success']['username'];
    $email = $_SESSION['success']['email'];
    echo "<script>
        Swal.fire({
            title: 'Registration Successful!',
            text: 'Welcome, $username! Your email: $email',
            icon: 'success',
            confirmButtonText: 'Continue'
        });
    </script>";
    unset($_SESSION['success']); // Clear success session
}


// Check if session has an error message
if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    echo "<script>
        Swal.fire({
            title: 'Error!',
            text: '$errorMessage',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    </script>";
    unset($_SESSION['error']); // Clear error session
}

?>
</body>
</html>
