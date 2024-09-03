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

// Fetch admin details
$admin_id = $_SESSION['admin_id'];
$result = $conn->query("SELECT nama_lengkap, username FROM admin WHERE id=$admin_id");
$row = $result->fetch_assoc();
$nama_lengkap = $row['nama_lengkap'];
$username = $row['username'];

// Update Password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in the database
        $update_stmt = $conn->prepare("UPDATE admin SET password=? WHERE id=?");
        $update_stmt->bind_param("si", $hashed_password, $admin_id);

        if ($update_stmt->execute()) {
            $message = "Password updated successfully!";
        } else {
            $message = "Error updating password: " . $update_stmt->error;
        }

        $update_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Times New Roman', serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .profile {
            margin: 50px auto;
            width: 350px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .profile p {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .profile input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: 'Times New Roman', serif;
        }
        .profile input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            box-sizing: border-box;
            font-family: 'Times New Roman', serif;
            font-size: 18px;
        }
        .profile input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 10px;
            color: #007bff;
            font-size: 18px;
        }
        a {
            color: blue;
            text-decoration: underline;
            font-size: 18px;
            font-family: 'Times New Roman', serif;
        }
    </style>
</head>
<body>
    <div class="profile">
        <h2>Admin Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p><strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($nama_lengkap); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <label for="new_password">New Password:</label><br>
            <input type="password" name="new_password" required><br>
            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" name="confirm_password" required><br>
            <input type="submit" value="Update Password">
        </form>
        <div class="message"><?php echo isset($message) ? htmlspecialchars($message) : ""; ?></div>
        <a href="admin_dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>
