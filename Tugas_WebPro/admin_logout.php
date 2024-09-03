<?php
session_start();

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    // User confirmed logout
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit();
} else {
    // User did not confirm logout, redirect to confirmation page
    header("Location: confirm_logout.html");
    exit();
}
?>
