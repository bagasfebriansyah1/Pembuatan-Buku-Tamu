<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Redirect to DataKomentar_BagasFebriansyah_Input.php
header("Location: DataKomentar_BagasFebriansyah_Input.php");
exit();
?>
