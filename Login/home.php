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
$query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$row = mysqli_fetch_array($query);
$favoritos = $row['fav'];
if($favoritos != ''){
  header('Location: ../index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style2.css" media="all" type="text/css">
<script src="https://kit.fontawesome.com/df1511442e.js" crossorigin="anonymous"></script>
<title>Home</title>
<style>
a, a:visited{
color: rgba(255, 201, 255, 0.5);
}
a:hover{
color: #EE0000;
}
body{
  zoom: 1.5;
  -moz-transform:  scale(1.5,1.5);
  -moz-transform-origin: top center;
  background-image: url("./img/gatinhos2.jpg");
  background-color: lightblue;
  background-repeat: repeat;
  background-attachment: fixed;
  background-size: 100%;
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
  <div id="content">
<h2>Ola <?php echo $userData['username'];?>, estamos felizes em te ver por aqui. </h1>
<br>
<h3> Para começar, selecione as coisas mais legais do mundo!</h3>
<!--Selecionar os favoritos, logo começaremos a estudar a entidade-->
<!--------->
<div id="hide1"></div>
<button onclick="hide01();this.disabled=true">#Animais</button>
<div id="hide1a"></div>
<!--------->
<div id="hide2"></div>
<button onclick="hide02();this.disabled=true">#Paisagens</button>
<div id="hide2a"></div>
<!--------->
<div id="hide3"></div>
<button onclick="hide03();this.disabled=true">#Haha</button>
<div id="hide3a"></div>
<!--------->
<div id="hide4"></div>
<button onclick="hide04();this.disabled=true">#Livros</button>
<div id="hide4a"></div>
<!--------->
<div id="hide5"></div>
<button onclick="hide05();this.disabled=true">#Flores</button>
<div id="hide5a"></div>
<!--------->
<div id="hide6"></div>
<button onclick="hide06();this.disabled=true">#Viagens</button>
<div id="hide6a"></div>
<!--------->
<div id="hide7"></div>
<button onclick="hide07();this.disabled=true">#Astronomia</button>
<div id="hide7a"></div>
<!--------->
<div id="hide8"></div>
<button onclick="hide08();this.disabled=true">#Gastronomia</button>
<div id="hide8a"></div>
<!--------->
<div id="hide9"></div>
<button onclick="hide09();this.disabled=true">#Lazer</button>
<div id="hide9a"></div>
<!--------->
<div id="hide10"></div>
<button onclick="hide010();this.disabled=true">#Música</button>
<div id="hide10a"></div>
<!--------->
<button onclick="hide011();this.disabled=true">#Arte</button>
<div id="hide10a"></div>
<!------>
<hr/>
<h3> De cookies <i class='fas fa-cookie'></i> para os melhores.</h3>
<div id="outputDiv"></div></div>
<form action="favregister.php" method="post">
<input type="text" id="favs" name="favoritos" style="display:none;"></input>
<input type="submit">Tudo pronto</input><br/><br/>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
var x;
var Stringval = "";
var times = 0;
var maxtimesearch = 4;
var Favoritos=""; //Aqui ele vai guardar onde o usuario curtiu. (ele guarda 5 letras por tag.)
function JavaScriptFetch() {
    var script = document.createElement('script');
    script.src = "https://api.flickr.com/services/feeds/photos_public.gne?format=json&tags=" + Stringval;;
    document.querySelector('head').appendChild(script);
}

function jsonFlickrFeed(data) {
    var image = "";
    data.items.forEach(function (element) {
          if(times < maxtimesearch){
            //O nome do author esta vindo como noname@gmail.com (JhonDoe), então vou deixa ele apenas para "jhon doe":
        image += "</center><legend id='autor'>  " + element.author.slice(20 , -2)  + "</legend><center>"; //Aqui vai ficar o nome de quem publicou
        image += "<legend id='data'>" + element.published.slice(0 , -10) + "</legend>"; //aqui vai ficar a data
        image += "<img src='" + element.media.m + "' id='images'/>"; //Aqui vai ficar a imagem
        image += "<div id='cabecalho'><i align='left' onclick='likebutton(this)' id='like' class='fas fa-cookie'></i></div><p  id='titulo'align='left'>" + element.title + "</p><br/><br/></div><br>"; //Aqui vai ficar o titulo ou a descrição.

        times+=1;
      }
    });

    document.getElementById("outputDiv").innerHTML += image;
    times = 0;
  }

function likebutton(x){
  x.style.color = "rgb(252, 222, 177)";
  x.classList.toggle("fa-cookie-bite");
}
function hide01(){
    x = document.getElementById("hide1");
    Stringval = "Animais";
    Favoritos += "Animals,";
    Toggle();
    x = document.getElementById("hide1a");
    Toggle();
    JavaScriptFetch();
}
function hide02(){
    x = document.getElementById("hide2");
    Stringval = "Paisagens";
    JavaScriptFetch();
    Favoritos += "Sights,";
    Toggle();
    x = document.getElementById("hide2a");
    Toggle();
}
function hide03(){
    x = document.getElementById("hide3");
    Stringval = "animals funny";
    JavaScriptFetch();
    Favoritos += "animal funny,";
    Toggle();
    x = document.getElementById("hide3a");
    Toggle();
}
function hide04(){
    x = document.getElementById("hide4");
    Stringval = "Livro";
    JavaScriptFetch();
    Favoritos += "Book,";
    Toggle();
    x = document.getElementById("hide4a");
    Toggle();
}
function hide05(){
    x = document.getElementById("hide5");
    Stringval = "Flores";
    JavaScriptFetch();
    Favoritos += "Flowers,";
    Toggle();
    x = document.getElementById("hide5a");
    Toggle();
}
function hide06(){
    x = document.getElementById("hide6");
    Stringval = "Viagens";
    JavaScriptFetch();
    Favoritos += "trip,";
    Toggle();
    x = document.getElementById("hide6a");
    Toggle();
}
function hide07(){
    x = document.getElementById("hide7");
    Stringval = "Astrono";
    JavaScriptFetch();
    Favoritos += "Stars,";
    Toggle();
    x = document.getElementById("hide7a");
    Toggle();
}
function hide08(){
    x = document.getElementById("hide8");
    Stringval = "Gastronomia";
    JavaScriptFetch();
    Favoritos += "Gastronomy,";
    Toggle();
    x = document.getElementById("hide8a");
    Toggle();
}
function hide09(){
    x = document.getElementById("hide9");
    Stringval = "façavocêmesmo";
    JavaScriptFetch();
    Favoritos += "do it yourself,";
    Toggle();
    x = document.getElementById("hide9a");
    Toggle();
}
function hide010(){
    x = document.getElementById("hide10");
    Stringval = "music";
    JavaScriptFetch();
    Favoritos += "music,";
    Toggle();
    x = document.getElementById("hide10a");
    Toggle();
}
function hide011(){
    x = document.getElementById("hide11");
    Stringval = "Artistic Bros";
    JavaScriptFetch();
    Favoritos += "Artistic Bros,";
    Toggle();
    x = document.getElementById("hide11a");
    Toggle();
}
function Toggle() {
    document.getElementById("favs").value = Favoritos;
  if (x.style.display === "none") {
  } else {
    x.style.display = "none";
    x.style.display = "none";
  }
}

$(document).ready(function () {
    $("#reset").click(function (e) {
        location.reload();
    });

    $("#submit").click(function (e) {
        $("#outputDiv").html("");
    });
});
</script>
</script>
<br>
<a href="logout.php">Sair</a>
</fieldset>
</center>
</div>
</div>
<link rel="stylesheet" href="style2.css" media="all" type="text/css">
</body>
</html>
