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

// Fetch data for dashboard
$total_comments_result = $conn->query("SELECT COUNT(*) as count FROM pengunjung");
$unreplied_comments_result = $conn->query("SELECT COUNT(*) as count FROM pengunjung WHERE id NOT IN (SELECT pengunjung_id FROM responses)");

if ($total_comments_result && $unreplied_comments_result) {
    $total_comments = $total_comments_result->fetch_assoc()['count'];
    $unreplied_comments = $unreplied_comments_result->fetch_assoc()['count'];
} else {
    $total_comments = $unreplied_comments = 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Times New Roman;
            margin: 0;
            padding: 0;
        }
        .dashboard {
            width: 80%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1, h2 {
            color: #333;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }
        .stat {
            flex: 1;
            padding: 20px;
            border-radius: 5px;
            background-color: #f2f2f2;
        }
        .stat h2 {
            margin-top: 0;
        }
        .stat p {
            margin: 5px 0;
            font-size: 24px;
            color: #555;
        }
        .links {
            text-align: center;
            margin-top: 30px;
        }
        .links a {
            margin: 0 10px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
<div style="text-align:center;">
    <img src="Logo STMIK Antar Bangsa.png" style="width: 270px; height: auto;"><br>
    <h1 style="line-height:0; font-size: 40px;">DASHBOARD ADMIN FEBRI</h1>
    <h2 style="line-height:1; font-size: 25px;">Bagas Febriansyah (2220001)</h2>
    <h3 style="line-height:0; font-size: 25px;">Sistem Informasi 2.4D</h3>
</div>
    <div class="dashboard">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="stats">
            <div class="stat">
                <h2>Total Comments</h2>
                <p><?php echo htmlspecialchars($total_comments); ?></p>
            </div>
            <div class="stat">
                <h2>Unreplied Comments</h2>
                <p><?php echo htmlspecialchars($unreplied_comments); ?></p>
            </div>
        </div>
        <div class="links">
            <a href="view_comments.php">Lihat Daftar Buku Tamu</a>
            <a href="admin_profile.php">Profile Admin</a>
            <a href="admin_logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
