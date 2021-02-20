<?php
session_start();
require 'db_connection.php';
require 'insert_user.php';
// IF USER LOGGED IN
if(isset($_SESSION['user_email'])){
header('Location: home.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadasxtro</title>
<link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>

<body>
  <center>
<fieldset>
<form action="" method="post">
<h2>Ola, seja bem vindo.</h2>

<div class="container">
<label for="username"><legend>Nome</legend></label>
<input type="text" placeholder="Como você se chama?" id="username" name="username" required><br><br>

<label for="email"><legend>Email</legend></label>
<input type="email" placeholder="Qual seu email?" id="email" name="user_email" required><br><br>

<label for="password"><legend>Senha</legend></label>
<input type="password" placeholder="Digite uma senha" id="password" name="user_password" required><br/><br>
<br><button type="submit">Cadastrar</button>
<a href="index.php"><button type="button" class="Regbtn">Login</button></a>

</div>
<?php
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>';
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>';
}
?>
</form>
</fieldset></center>
</body></html>
