<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buku_tamu";

$conn = new mysqli("localhost", "root", "", "buku_tamu");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (nama_lengkap, username, password, role) VALUES (?, ?, ?, ?)");
        $role = "Administrator";
        $stmt->bind_param("ssss", $nama_lengkap, $username, $hashed_password, $role);
        
        if ($stmt->execute()) {
            $message = "Registration successful!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambahkan Admin</title>
    <style>
        body {
            background-color: #e9e9e9;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            width: 350px;
            padding: 40px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        .form-container input[type="text"], 
        .form-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 20px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambahkan Admin</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required><br>
            <input type="submit" value="Tambahkan">
        </form>
        <div class="message"><?php echo $message; ?></div>
        <div class="message"><a href="admin_login.php">Kembali Ke Menu Login</a></div>
    </div>
</body>
</html>
