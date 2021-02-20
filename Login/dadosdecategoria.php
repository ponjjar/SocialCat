<?php
session_start();
require 'db_connection.php';
// CHECK USER IF LOGGED IN
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){

$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);

}else{
header('Location: logout.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css" media="all" type="text/css">
<title>Home</title>
<style>
a, a:visited{
color: rgba(255, 201, 255, 0.5);
}
a:hover{
color: #EE0000;
}

#divBusca{
 background-color:#2F4F4F;
 border:solid 1px;
 border-radius:15px;
 width:300px;
}

#txtBusca{
 float:left;
 background-color:transparent;
 padding-left:5px;
 font-style:italic;
 font-size:18px;
 border:none;
 height:32px;
 width:260px;
}


</style>
</head>

<body>
<div class="container">
  <center>
<fieldset>
  <legend></legend>
  <style>
  h2{
  color: rgb(255, 212, 255);
  }
  </style>
<h2>Vamos fazer um upload!</h2>
<form action="" method="post">
<legend> Qual a categoria?</legend>
  <div id="divBusca">
    <select id="categorias" name="categoria">
        <option value="Animais">Animal</option>
        <option value="Paisagens">Paisagem</option>
        <option value="Comédia">Comédia</option>
        <option value="Livros">Livro</option>
        <option value="Agricultura">Agricultura</option>
        <option value="Viagens">Viagem</option>
        <option value="Astronomia">Astronomia</option>
        <option value="Gastronomia">Gastronomia</option>
        <option value="Lazer">Lazer</option>
      </select>
</div>
<legend> Qual o link?</legend>
  <input placeholder="insira a url da imagem..." type="text"></input>

  <br><br><button type="submit">Enviar</button>
<br>
<br>
<?php
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>';
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>';
}
?>
<!--- Continue daqui, falta terminar de fazer o envio para o banco de dados, nas 2 colunas a categoria e o link, a gnt consegue!-->
</form>
<a href="logout.php">Sair</a>
</fieldset>

</center>
</div>
</body>
</html>
