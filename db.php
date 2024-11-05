
<?php
$host = 'sql101.infinityfree.com';
$db = 'if0_37657884_books';
$user = 'if0_37657884';
$pass = 'OF4SGMdCeJaWHr';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
