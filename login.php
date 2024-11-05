<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: guestbook.php");
    } else {
        echo "<div style='color: red;'>Неправильне ім'я користувача або пароль.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Вхід</h2>
        <form method="POST">
            Username: <input type="text" name="username" required>
            Password: <input type="password" name="password" required>
            <button type="submit">Увійти</button>
        </form>
        <a href="register.php">Зареєструватися</a>
    </div>
    <footer style="text-align: center; margin-top: 20px;">
        <p>Created by Artur Ashykhmin</p>
    </footer>
</body>
</html>
