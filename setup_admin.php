<?php
require 'config.php';
$username='admin';$password=password_hash('Admin@123',PASSWORD_DEFAULT);
try{$s=$pdo->prepare("INSERT INTO admins(username,password) VALUES(?,?)");$s->execute([$username,$password]);echo "Admin created. Username: admin; password: Admin@123. Delete setup_admin.php now.";}
catch(PDOException $e){echo "Admin may already exist. If so, delete this file. ".$e->getMessage();}
?>