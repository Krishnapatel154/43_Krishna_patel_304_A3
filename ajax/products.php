<?php
require '../config.php';
header('Content-Type: application/json; charset=utf-8');
$categoryId = filter_input(INPUT_GET,'category',FILTER_VALIDATE_INT) ?: 0;
$page = max(1, filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT) ?: 1);
$perPage=6;
$stmt=$pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id=?"); $stmt->execute([$categoryId]); $total=(int)$stmt->fetchColumn();
$pages=max(1,(int)ceil($total/$perPage)); $page=min($page,$pages); $offset=($page-1)*$perPage;
$stmt=$pdo->prepare("SELECT id,pname,price,picture FROM products WHERE category_id=? ORDER BY id DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1,$categoryId,PDO::PARAM_INT); $stmt->bindValue(2,$perPage,PDO::PARAM_INT); $stmt->bindValue(3,$offset,PDO::PARAM_INT); $stmt->execute();
echo json_encode(['products'=>$stmt->fetchAll(),'page'=>$page,'pages'=>$pages]);
