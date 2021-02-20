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
  <style>
  h2{
  color: rgb(255, 212, 255);
  }
  </style>
<h2>Ola <?php echo $userData['username'];?></h1>
  <div id="divBusca">
  <input type="text" id="txtBusca" placeholder="Buscar..."/>
</div>
<br>
<br>
<a href="logout.php">Sair</a>
</fieldset>
</center>
</div>
</body>
</html>
