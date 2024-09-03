<!DOCTYPE html>
<html>
<head>
    <title>BUKU TAMU</title>
    <style>
        body {
            background-color: pink;
            font-size: 30px;
            color: Black;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            margin: auto;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        input[type="text"], select, textarea {
            width: 250px;
            padding: 5px;
            border-radius: 5px;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            background-color: #fff;
            color: green;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            color: blue;
            text-decoration: underline;
        }
        .button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #fff;
            color: green;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div style="text-align:center;">
    <img src="Logo STMIK Antar Bangsa.png" style="width: 270px; height: auto;"><br>
    <h1 style="line-height:0; font-size: 40px;">BUKU TAMU OUTPUT DATA</h1>
    <h2 style="line-height:1; font-size: 25px;">Bagas Febriansyah (2220001)</h2>
    <h3 style="line-height:0; font-size: 25px;">Sistem Informasi 2.4D</h3>
</div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "buku_tamu";

        // Create connection
        $conn = new mysqli("localhost", "root", "", "buku_tamu");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data yang dikirimkan melalui formulir
        $nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
        $komentar = isset($_POST["komentar"]) ? $_POST["komentar"] : "";

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO pengunjung (nama, email, telephone, komentar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $telephone, $komentar);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<table>";
            echo "<tr><th colspan='2'>DATA YANG ANDA KIRIMKAN</th></tr>";
            echo "<tr><td>Nama  </td><td>: $nama</td></tr>";
            echo "<tr><td>Email </td><td>: $email</td></tr>";
            echo "<tr><td>Nomor Telephone </td><td>: $telephone</td></tr>";
            echo "<tr><td>Komentar </td><td>: ".nl2br($komentar)." </td></tr>";
            echo "</table>";
            echo '<a href="DataKomentar_BagasFebriansyah_Input.php">INPUT DATA LAGI</a>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Jika tidak ada data yang dikirimkan, tampilkan pesan kesalahan
        echo "<h2>Formulir Tidak Dikirimkan/Tidak Ditemukan</h2>";
    }
    ?>
    <br>
    <button class="button" onclick="window.location.href='view_comments.php'">Lihat Daftar Buku Tamu</button>
</body>
</html>
