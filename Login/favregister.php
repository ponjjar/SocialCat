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
$favoritos = $_POST["favoritos"] ;
echo $favoritos;
//Inserindo os dados favoritos que a pessoa selecionou.
mysqli_query($db_connection,"UPDATE users SET fav = '$favoritos' WHERE user_email='$user_email'");
//mysql_query("UPDATE cadastro3 SET nome ='$Nome',experiencia='$experiencia',email='$email' WHERE id=$id");
// mysqli_query($db_connection, "INSERT INTO `users` (fav) VALUES ('$favoritos')");
//$insert_user = mysqli_query($db_connection, "INSERT INTO `fav` FROM `users` where user_email ='$user_email' (fav) VALUES ('$favoritos')";
//"SELECT `fav` FROM `users` WHERE user_email = '$user_email'")
echo '<input id="recomendados" type="text" value="'. $favoritos.'/">';
?>
<script>
  window.location.href = "../index.php";
</script>
