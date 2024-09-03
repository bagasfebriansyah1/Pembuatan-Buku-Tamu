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

// Fetch comments
$sql = "SELECT id, nama, email, telephone, komentar FROM pengunjung";
$result = $conn->query($sql);
$jumlah = $result->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <title>DATA BUKU TAMU</title>
    <style>
        body {
            background-color: #90EE90; /* Light green background */
            font-size: 16px; /* Smaller font size for better readability */
            font-family: Times New Roman; /* Change font to Arial */
            color: #333; /* Darker font color for contrast */
        }
        table {
            border-collapse: collapse;
            margin: auto;
            width: 80%;
            background-color: #fff; /* Ensure table background is white */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add slight shadow for better appearance */
        }
        th, td {
            padding: 12px; /* Increased padding for better spacing */
            text-align: center; /* Center text */
        }
        th {
            background-color: #FF69B4; /* Pink header background */
            color: white; /* White text for headers */
        }
        td {
            background-color: #fff; /* Ensure cells are white */
            border: 1px solid #ccc; /* Light gray border for cells */
        }
        a {
            color: #0066cc; /* Blue links */
            text-decoration: none; /* Remove underline from links */
        }
        a:hover {
            text-decoration: underline; /* Underline links on hover */
        }
        .button {
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            background-color: #4CAF50; /* Green button */
            color: white; /* White text */
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* Remove underline from button links */
            display: inline-block; /* Ensure buttons display correctly */
        }
        .button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .header-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-title h1, .header-title h2, .header-title h3 {
            margin: 5px 0; /* Reduce margin for titles */
        }
        .centered-box {
        text-align: center;
        margin-top: 20px; /* Margin top to give space */
    }
    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
    }
    </style>
</head>
<body>
<div style="text-align:center;">
    <img src="Logo STMIK Antar Bangsa.png" style="width: 270px; height: auto;"><br>
    <h1 style="line-height:0; font-size: 40px;">LIST DAFTAR BUKU TAMU</h1>
    <h2 style="line-height:1; font-size: 25px;">Bagas Febriansyah (2220001)</h2>
    <h3 style="line-height:0; font-size: 25px;">Sistem Informasi 2.4D</h3>
</div>
<?php
if (isset($_SESSION['success_message'])) {
    echo '<p style="color: green;">' . $_SESSION['success_message'] . '</p>';
    unset($_SESSION['success_message']);
} else {
    // Tombol "Input Barang" di tengah tepat di atas pesan "Tidak ada data."
    echo '<div class="centered-box">';
    echo '<a href="DataKomentar_BagasFebriansyah_Input.php" class="button">Tambahkan Daftar Tamu</a>';
    echo '</div>';
    echo '<p style="text-align: center;"></p>';
}
?>

<table border="1">
    <tr>
        <td colspan="8" align="center"><h1><b>DATA BUKU TAMU</b></h1></td>
    </tr>
    <tr align="center" bgcolor="#FF69B4">
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Pesan</th>
        <th colspan="4"><b>Aksi</b></th> <!-- Gabungan kolom aksi -->
    </tr>
    <?php
    $no = 1; // Inisialisasi nomor urut
    while ($row = $result->fetch_assoc()) {
        $a = $row['id'];
        $b = $row['nama'];
        $c = $row['email'];
        $d = $row['komentar'];
    ?>
    <tr align="center">
        <td><?php echo $no++; ?></td>
        <td><?php echo htmlspecialchars($b); ?></td>
        <td><?php echo htmlspecialchars($c); ?></td>
        <td><?php echo nl2br(htmlspecialchars($d)); ?></td>
        <td><a href="delete_comment.php?id=<?php echo $a; ?>" onclick="return confirm('Yakin mau hapus item?');">Hapus</a></td>
        <td><a href="edit.php?id=<?php echo $a; ?>">Edit</a></td>
        <td><a href="reply_comment.php?id=<?php echo $a; ?>">Reply</a></td>
        <td><a href="DataKomentar_BagasFebriansyah_Input.php">Add</a></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="8" align="center">Jumlah Record: <?php echo $jumlah; ?></td>
    </tr>
</table>
<div class="centered-box">
    <a href="admin_dashboard.php" class="button">Kembali Ke Dashboard Admin</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
