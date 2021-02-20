<?php
session_start();
require 'db_connection.php';
require 'login.php';
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
<link rel="stylesheet" href="style.css" media="all" type="text/css">
<setlocale(LC_ALL,"pt-br")>
<title>Casdaxtro</title>
</head>

<body>
<center>
<fieldset>
<form action="" method="post">
<h2>Quem é você?</h2>

<div class="container">
<label for="email"><legend id="legendind">Email</legend></label>
<input type="email" placeholder="Digite seu email..." id="email" name="user_email" required>
<br/><br>
<label for="password"><legend id="legendind">Senha</legend></label>
<input type="password" placeholder="Digite sua senha..." id="password" name="user_password" required>
<br/><br><br>
<button type="submit">Login</button><a href="signup.php"><button type="button" class="Regbtn">Criar</button></a><br><br>
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
</fieldset>
</center>
</body></html>
