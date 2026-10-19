<?php require 'config.php';
$categories = $pdo->query("SELECT id,name FROM categories ORDER BY name")->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Shopping Cart</title><link rel="stylesheet" href="assets/style.css"></head><body>
<header><h1>PHP Shopping Cart</h1><nav>
<a href="index.php">Home</a>
<a href="cart.php">Cart (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a>
<?php if (!empty($_SESSION['user_id'])): ?>
<span>Welcome, <?= h($_SESSION['user_name'] ?? 'User') ?></span>
<a href="logout.php">User Logout</a>
<?php else: ?>
<a href="register.php">Register</a><a href="login.php">User Login</a>
<?php endif; ?>
<?php if (!empty($_SESSION['admin_id'])): ?>
<a href="admin/index.php">Admin Dashboard</a><a href="admin/logout.php">Admin Logout</a>
<?php else: ?>
<a href="admin_login.php">Admin Login</a>
<?php endif; ?>
<a href="practicals/index.php">Practicals 2–6</a>
</nav></header>
<main><h2>Categories</h2><div class="categories"><?php foreach($categories as $c): ?><a class="category" href="products.php?category=<?= (int)$c['id'] ?>"><?= h($c['name']) ?></a><?php endforeach; ?></div>
<h2>Welcome</h2><p>Select a category to browse products.</p></main><script src="assets/app.js"></script></body></html>