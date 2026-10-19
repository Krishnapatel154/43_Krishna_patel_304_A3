<?php require 'config.php'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=trim($_POST['email']??'');$password=$_POST['password']??'';
 $s=$pdo->prepare("SELECT id,name,password FROM users WHERE email=?");$s->execute([$email]);$u=$s->fetch();
 if($u && password_verify($password,$u['password'])){session_regenerate_id(true);$_SESSION['user_id']=$u['id'];$_SESSION['user_name']=$u['name'];header('Location: index.php');exit;} $error='Invalid email or password.';
}
?><!doctype html><html><head><meta charset="utf-8"><title>User Login</title><link rel="stylesheet" href="assets/style.css"></head><body><main><h1>User Login</h1><?php if(isset($_GET['registered'])):?><p class="success">Registration successful. Please log in.</p><?php endif;?><?php if($error):?><p class="error"><?=h($error)?></p><?php endif;?><form method="post"><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button>Login</button></form><p><a href="register.php">Register</a> · <a href="index.php">Home</a></p></main></body></html>