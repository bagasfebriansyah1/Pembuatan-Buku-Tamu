<?php
session_start();

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "buku_tamu";

$conn = new mysqli("localhost", "root", "", "buku_tamu");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($admin_id, $hashed_password);
    $stmt->fetch();

    if ($hashed_password && password_verify($password, $hashed_password)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin_id;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}
$conn->close();
?>
