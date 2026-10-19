<?php require 'config.php';
$categoryId = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT) ?: 0;
$stmt=$pdo->prepare("SELECT * FROM categories WHERE id=?"); $stmt->execute([$categoryId]); $category=$stmt->fetch();
if(!$category){http_response_code(404); exit('Category not found. <a href="index.php">Home</a>');}
?>
<!doctype html><html><head><meta charset="utf-8"><title><?= h($category['name']) ?></title><link rel="stylesheet" href="assets/style.css"></head><body>
<header><h1><?= h($category['name']) ?></h1><nav><a href="index.php">Home</a><a href="cart.php">Cart</a><a href="login.php">Login</a></nav></header>
<main><div id="product-list" data-category="<?= (int)$categoryId ?>">Loading products...</div></main>
<script src="assets/app.js"></script></body></html>