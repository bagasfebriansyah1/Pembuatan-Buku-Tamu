<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buku_tamu";

$conn = new mysqli("localhost", "root", "", "buku_tamu");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pengunjung_id = $_GET['id'];

// Delete comment and related responses
$conn->query("DELETE FROM responses WHERE pengunjung_id=$pengunjung_id");
$conn->query("DELETE FROM pengunjung WHERE id=$pengunjung_id");

$conn->close();
header("Location: view_comments.php");
exit();
?>
