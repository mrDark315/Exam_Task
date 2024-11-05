<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $pdo->prepare("INSERT INTO guestbook (user_id, message) VALUES (?, ?)");
    $stmt->execute([$user_id, $message]);
}

$stmt = $pdo->query("SELECT guestbook.message, users.username, guestbook.created_at FROM guestbook JOIN users ON guestbook.user_id = users.id ORDER BY guestbook.created_at DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостьова книга</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Гостьова книга</h2>
        <form method="POST">
            Message: <textarea name="message" required></textarea>
            <button type="submit">Додати повідомлення</button>
        </form>
        <h3>Повідомлення</h3>
        <?php foreach ($messages as $message): ?>
            <p><strong><?php echo htmlspecialchars($message['username']); ?></strong> (<?php echo $message['created_at']; ?>): <?php echo htmlspecialchars($message['message']); ?></p>
        <?php endforeach; ?>
        <a href="logout.php">Вийти</a>
    </div>
    <footer style="text-align: center; margin-top: 20px;">
        <p>Created by Artur Ashykhmin</p>
    </footer>
</body>
</html>
