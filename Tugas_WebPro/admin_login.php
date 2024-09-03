<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
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
        .form-container .link-container {
            margin-top: 20px;
        }
        .form-container a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }
        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form action="admin_login_handler.php" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        <div class="link-container">
            <a href="add_admin.php">Tambahkan Admin</a>
        </div>
    </div>
</body>
</html>
