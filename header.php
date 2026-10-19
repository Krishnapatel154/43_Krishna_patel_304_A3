<?php require_once __DIR__ . '/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title ?? APP_NAME) ?></title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
  <a class="brand" href="index.php">ShopEasy</a>
  <nav>
    <a href="index.php">Home</a>
    <a href="cart.php">Cart (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a>
    <?php if (is_user()): ?>
      <span class="nav-muted">Hi, <?= e($_SESSION['user_name'] ?? 'User') ?></span>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    <?php endif; ?>
    <a href="admin_login.php">Admin</a>
  </nav>
</header>
<main class="container">
