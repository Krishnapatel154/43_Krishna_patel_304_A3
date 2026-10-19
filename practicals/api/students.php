<?php
// Small PHP REST API for Practical 6. Returns students as JSON.
require_once __DIR__ . '/../../config.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
try {
    $rows = $pdo->query('SELECT roll_no, name, email, course FROM students ORDER BY roll_no')->fetchAll();
    echo json_encode(['success' => true, 'count' => count($rows), 'students' => $rows], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database query failed. Check students table and database config.']);
}
