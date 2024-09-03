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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengunjung_id = $_POST['pengunjung_id'];
    $response = $_POST['response'];

    // Insert response into database
    $stmt = $conn->prepare("INSERT INTO responses (pengunjung_id, response) VALUES (?, ?)");
    $stmt->bind_param("is", $pengunjung_id, $response);

    if ($stmt->execute()) {
        // Fetch email of the original comment
        $result = $conn->query("SELECT email FROM pengunjung WHERE id=$pengunjung_id");
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Send notification email
        $to = $email;
        $subject = "Response to your comment";
        $message = "Hi, \n\nYou have received a response to your comment. \n\nResponse: $response \n\nThank you.";
        $headers = "From: admin@example.com";

        mail($to, $subject, $message, $headers);

        // Update notification status
        $conn->query("UPDATE pengunjung SET notification_sent = TRUE WHERE id=$pengunjung_id");

        echo "Response sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

$pengunjung_id = $_GET['id'];

// Fetch original comment
$result = $conn->query("SELECT nama, komentar FROM pengunjung WHERE id=$pengunjung_id");
$row = $result->fetch_assoc();
$nama = $row['nama'];
$komentar = $row['komentar'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reply to Comment</title>
    <style>
        body {
            background-color: yellow; /* Light yellow background */
            font-family: Times New Roman; /* Arial font */
            font-size: 18px; /* Font size */
            text-align: center; /* Centered text */
            margin: 0;
            padding: 0;
        }
        .reply-form {
            margin: 50px auto; /* Center form with auto margins */
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff; /* White background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
        }
        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333; /* Dark text color */
        }
        p {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555; /* Gray text color */
        }
        textarea {
            width: calc(100% - 22px);
            height: 100px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px;
            resize: none;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50; /* Green background */
            color: #fff; /* White text */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .centered-box {
            text-align: center;
            margin-top: 20px; /* Space above */
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            text-align: center;
            text-decoration: none; /* Remove underline */
            font-size: 16px; /* Font size */
            border-radius: 5px; /* Rounded corners */
        }
        .button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
<div style="text-align:center;">
    <img src="Logo STMIK Antar Bangsa.png" style="width: 270px; height: auto;"><br>
    <h1 style="line-height:0; font-size: 40px;">BUKU TAMU REPLY COMMENT</h1>
    <h2 style="line-height:1; font-size: 25px;">Bagas Febriansyah (2220001)</h2>
    <h3 style="line-height:0; font-size: 25px;">Sistem Informasi 2.4D</h3>
</div>
    <div class="reply-form">
        <h2>Reply to Comment</h2>
        <p><strong>Nama:</strong> <?php echo $nama; ?></p>
        <p><strong>Komentar:</strong> <?php echo nl2br($komentar); ?></p>
        <form action="reply_comment.php" method="post">
            <textarea name="response" placeholder="Your response..." required></textarea><br>
            <input type="hidden" name="pengunjung_id" value="<?php echo $pengunjung_id; ?>">
            <input type="submit" value="Send Response">
        </form>

        <div class="centered-box">
        <a href="admin_dashboard.php" class="button">Kembali Ke Dashboard Admin</a>
        </div>
    </div>
</body>
</html>
