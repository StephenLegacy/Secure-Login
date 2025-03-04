<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <link rel="stylesheet" href="/assets/styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="contact-container">
        <h1>Welcome, <span>Log Back In</span></h1>

        <div class="contact-form">
            <h2>Welcome Back</h2>

            <form id="loginForm" action="auth.php" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter Your Username" required>

                <label for="password">Your Password</label>
                <input type="password" name="password" id="password" placeholder="Your Password Contains 8 Characters & Above" required>

                <button type="submit">Log In</button>
            </form>

            <!-- Registration Button -->
            <div class="register-button">
                <p>Don't have an account? <a href="register.php"><button type="button">Register Now</button></a></p>
            </div>
        </div>

        <div class="contact-info">
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
    </div>

    <footer>
        <!-- <p>&copy; Secure Log In Solutions. All rights reserved.</p> -->
    </footer>

    <?php
    if (isset($_SESSION['login_status'])) {
        if ($_SESSION['login_status'] == "success") {
            echo "<script>
                Swal.fire({
                    title: 'Login Successful!',
                    text: 'Welcome back, " . $_SESSION['username'] . "!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'portal.php';
                });
            </script>";
        } elseif ($_SESSION['login_status'] == "failed") {
            echo "<script>
                Swal.fire({
                    title: 'Login Failed!',
                    text: 'Invalid username or password. Please try again.',
                    icon: 'error',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>";
        }
        unset($_SESSION['login_status']); // Remove session variable after displaying message
    }
    ?>

</body>
</html>
