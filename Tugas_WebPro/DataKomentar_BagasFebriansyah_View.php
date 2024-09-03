<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku Tamu</title>
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
            border: 1px solid black;
        }
        a {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div style="text-align:center;">
    <img src="Logo STMIK Antar Bangsa.png" style="width: 270px; height: auto;"><br>
    <h1 style="line-height:0; font-size: 40px;">BUKU TAMU INPUT DATA</h1>
    <h2 style="line-height:1; font-size: 25px;">Bagas Febriansyah (2220001)</h2>
    <h3 style="line-height:0; font-size: 25px;">Sistem Informasi 2.4D</h3>
</div>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "buku_tamu";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from database
    $sql = "SELECT nama, email, telephone, komentar FROM pengunjung";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Nama</th><th>Email</th><th>Nomor Telephone</th><th>Komentar</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["email"]. "</td><td>" . $row["telephone"]. "</td><td>" . nl2br($row["komentar"]). "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>Tidak ada data tamu yang ditemukan</h2>";
    }

    // Close connection
    $conn->close();
    ?>
    <br>
    <a href="DataKomentar_BagasFebriansyah_Input.php">Kembali ke Form</a>
</body>
</html>
