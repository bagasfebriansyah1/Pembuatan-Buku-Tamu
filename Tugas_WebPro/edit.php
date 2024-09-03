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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $komentar = $_POST['komentar'];

    // Update the comment in the database
    $sql = "UPDATE pengunjung SET nama=?, email=?, telephone=?, komentar=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nama, $email, $telephone, $komentar, $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Data berhasil diupdate";
        header("Location: view_comments.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET['id'];

    // Fetch the existing data
    $sql = "SELECT nama, email, telephone, komentar FROM pengunjung WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $nama = $row['nama'];
    $email = $row['email'];
    $telephone = $row['telephone'];
    $komentar = $row['komentar'];

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku Tamu</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], textarea {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-link {
            margin-top: 20px;
            display: inline-block;
            color: #0066cc;
            text-decoration: none;
            font-size: 16px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Buku Tamu</h1>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <label for="telephone">Nomor Telephone</label>
            <input type="text" name="telephone" id="telephone" value="<?php echo htmlspecialchars($telephone); ?>">
            <label for="komentar">Komentar</label>
            <textarea name="komentar" id="komentar" rows="5" required><?php echo htmlspecialchars($komentar); ?></textarea>
            <input type="submit" value="Update">
        </form>
        <a class="back-link" href="view_comments.php">Kembali ke Daftar Buku Tamu</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>