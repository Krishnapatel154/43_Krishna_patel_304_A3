<?php require 'config.php'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
  $captcha=trim($_POST['captcha']??'');
  if(!hash_equals((string)($_SESSION['captcha']??''),$captcha)) $error='CAPTCHA is incorrect.';
  elseif($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8) $error='Enter a name, valid email and password of at least 8 characters.';
  else { try{$s=$pdo->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");$s->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);unset($_SESSION['captcha']);header('Location: login.php?registered=1');exit;}catch(PDOException $e){$error='This email may already be registered.';} }
}
?><!doctype html><html><head><meta charset="utf-8"><title>Register</title><link rel="stylesheet" href="assets/style.css"></head><body><main><h1>User Registration</h1><?php if($error): ?><p class="error"><?= h($error) ?></p><?php endif; ?><form method="post"><label>Name<input name="name" required></label><label>Email<input type="email" name="email" required></label><label>Password (minimum 8 characters)<input type="password" name="password" minlength="8" required></label><label>CAPTCHA: <?= (int)($_SESSION['captcha'] = ($_SESSION['captcha'] ?? random_int(1000,9999))) ?><input name="captcha" required autocomplete="off"></label><button>Register</button></form><p><a href="login.php">Already registered? Login</a></p></main></body></html>