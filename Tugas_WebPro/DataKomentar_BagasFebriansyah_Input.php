<!DOCTYPE html>
<html>
<head>
    <title>BUKU TAMU STMIK ANTAR BANGSA</title>
    <style>
        body {
            background-color: yellow;
            font-size: 30px;
        }
        table {
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        input[type="text"], select {
            width: 250px;
            padding: 5px;
            border-radius: 5px;
        }
        input[type="radio"], input[type="checkbox"] {
            margin-right: 10px;
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
            .admin-login {
            margin-top: 10px;
            border: none;
            background-color: #fff;
            color: green;
            border-radius: 5px;
            cursor: pointer;
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
    <h1 style="line-height:0; font-size: 40px;">BUKU TAMU INPUT DATA</h1>
    <h2 style="line-height:1; font-size: 25px;">Bagas Febriansyah (2220001)</h2>
    <h3 style="line-height:0; font-size: 25px;">Sistem Informasi 2.4D</h3>
    <a href="view_comments.php" class="button">Lihat Daftar Tamu</a>
    <a href="admin_login.php" class="button">Login Admin</a>


</div>
    <form action="DataKomentar_BagasFebriansyah_Output.php" method="post">
        <table>
            <tr>
                <th style="text-align:center;" colspan="3">DATA PENGUNJUNG</th> 
            </tr>
            <tr>
                <td>Nama Anda</td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" size="25" maxlength="50"></td>
            </tr>
            <tr>
                <td>Email Anda</td>
                <td>:</td>
                <td><input type="text" name="email" id="email" size="25" maxlength="50"></td>
            </tr>
            <tr>
                <td>Nomor Telephone</td>
                <td>:</td>
                <td><input type="text" name="telephone" id="telephone" size="25" maxlength="50"></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td>:</td>
                <td><textarea name="komentar" id="komentar" cols="27" rows="5"></textarea></td>
            </tr>
            <tr>
            <td colspan="3" align="center">
                    <input type="submit" value="Kirim"> 
                    <input type="reset" value="Reset">    
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
