<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');

$category = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$category = max(0, (int)$category);
$page = max(1, (int)$page);
$perPage = 6;
$offset = ($page - 1) * $perPage;

if ($category > 0) {
    $countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM products WHERE category_id = ?");
    $countStmt->bind_param("i", $category);
} else {
    $countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM products");
}
$countStmt->execute();
$total = (int)$countStmt->get_result()->fetch_assoc()['total'];
$totalPages = max(1, (int)ceil($total / $perPage));

if ($category > 0) {
    $stmt = $conn->prepare("SELECT p.id,p.pname,p.price,p.picture,c.name AS category_name
      FROM products p JOIN categories c ON c.id=p.category_id
      WHERE p.category_id=? ORDER BY p.id DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("iii", $category, $perPage, $offset);
} else {
    $stmt = $conn->prepare("SELECT p.id,p.pname,p.price,p.picture,c.name AS category_name
      FROM products p JOIN categories c ON c.id=p.category_id
      ORDER BY p.id DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $perPage, $offset);
}
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
echo json_encode(['products' => $rows, 'page' => $page, 'totalPages' => $totalPages]);
