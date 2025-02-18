<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php


// Start the session to access session data
session_start();

// Destroy the session
session_unset();
session_destroy();

// Delete the session cookie (if used)
setcookie('user_logged_in', '', time() - 3600, '/', '', true, true);

// Redirect to login page
header('Location: login.php');
exit;
?>
