<?php
//severname, ROOT, banco de dados
$db_connection = mysqli_connect("localhost","root","","login_registration");
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
