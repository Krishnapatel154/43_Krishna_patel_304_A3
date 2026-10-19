<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$host = "localhost";
$dbname = "shopping_cart";
$dbuser = "root";
$dbpass = "root";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    die("Database connection failed. Check config.php and import database.sql. Details: " .
        htmlspecialchars($e->getMessage()));
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function require_admin() {
    if (empty($_SESSION['admin_id'])) {
        header('Location: ../admin_login.php');
        exit;
    }
}
function require_user() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
?>