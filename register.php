<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Реєстрація</h2>
        <form method="POST">
            Username: <input type="text" name="username" required>
            Password: <input type="password" name="password" required>
            <button type="submit">Зареєструватися</button>
        </form>
        <a href="login.php">Увійти</a>
    </div>
    <footer style="text-align: center; margin-top: 20px;">
        <p>Created by Artur Ashykhmin</p>
    </footer>
</body>
</html>
