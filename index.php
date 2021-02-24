<?php
session_start();
require './Login/db_connection.php';
// CHECK USER IF LOGGED IN
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){

$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);

}else{
header('Location: ./Login/logout.php');
exit;
}
//Inserindo os dados favoritos que a pessoa selecionou.
$query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$row = mysqli_fetch_array($query);
$favoritos = $row['fav'];


if($favoritos == ''){
  header('Location: ./Login/home.php');
  exit;
}
if(isset($_REQUEST['favoritosform'])){
  $seguir = $favoritos . $_POST["follow"];
  mysqli_query($db_connection,"UPDATE users SET fav = '$seguir' WHERE user_email='$user_email'");
  echo '<div id="j1"></div>';
}
//echo $favoritos;
//mysql_query("UPDATE cadastro3 SET nome ='$Nome',experiencia='$experiencia',email='$email' WHERE id=$id");
// mysqli_query($db_connection, "INSERT INTO `users` (fav) VALUES ('$favoritos')");
//$insert_user = mysqli_query($db_connection, "INSERT INTO `fav` FROM `users` where user_email ='$user_email' (fav) VALUES ('$favoritos')";
//"SELECT `fav` FROM `users` WHERE user_email = '$user_email'")
echo '<input id="recomendados" style="display:none;" type="text" value="'.$favoritos.'/">';

?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="target-densitydpi=device-dpi, initial-scale=0.6, user-scalable=no" />
<link rel="stylesheet" href="StylePrincipal25.css" media="all" type="text/css">
<title>Home</title>
<style>
a, a:visited{
color: rgba(255, 201, 255, 0.5);
}
a:hover{
color: #EE0000;
}
</style>
</head>

<body>
  <form action="" id='formfollow' method='post'>
    <input type='text' id='followinpt' name='follow' onsubmit="e.preventDefault()" style="display:none;"></input> <!------style="display:none;"--->
    <input type='submit' onsubmit="return false;" style="display:none;" name="favoritosform"id="favoritosform"></input>
  </form>
<div class="container">
  <center>
<fieldset>
  <style>
  h2{
  color: rgb(255, 212, 255);
  }
  </style>
  <div id="content">
<input placeholder="#" id="search"/>  <input type="submit" onclick="search()"/>
<h2 class="post">Ola, <?php echo $userData['username'];?>.</h2>
<a class="post"href="./Login/logout.php">Sair</a>
<!---<h2 class="post"> Olha o que encontramos para você 🧡</h2>--->

<div id="outputDiv"></div>
<button onclick="LoadFeed();">ver mais</button>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
document.location.reload(false);
</script>
<script src="https://kit.fontawesome.com/df1511442e.js" crossorigin="anonymous"></script>
<script>
var x;
var Stringval = "";
var times = 0;
var maxtimesearch = 8;
var i=0
const Favoritos= document.getElementById("recomendados").value; //Aqui ele vai guardar onde o usuario curtiu. (ele guarda 5 letras por tag.)
const Recomendados= Favoritos.split(/,(?! )/);
Feed();
function JavaScriptFetch() {
    var script = document.createElement('script');
    script.src = "https://api.flickr.com/services/feeds/photos_public.gne?format=json&lang=pt-br&tagmode=any&tags=" + Stringval;;
    document.querySelector('head').appendChild(script);
}
var y=0; //Essa variavel vai ser responsavel por criar elementos de "seguir" a cada y postagens :D
function jsonFlickrFeed(data) {
    var image = "";
      y+=1;
    data.items.forEach(function (element) {

          if(times < maxtimesearch){
            //O nome do author esta vindo como noname@gmail.com (JhonDoe), então vou deixa ele apenas para "jhon doe":
        image += "<div class='post'><br/></center><legend id='autor'>  " + element.author.slice(20 , -2)  + "</legend><center>"; //Aqui vai ficar o nome de quem publicou
        image += "<legend id='data'>" + element.published.slice(0 , -10) + "</legend>"; //aqui vai ficar a data
        image += "<img src='" + element.media.m + "' id='images'/>"; //Aqui vai ficar a imagem
        image += "<div id='cabecalho'><i align='left' onclick='likebutton(this)' id='like' class='fas fa-cookie'></i></div><textarea readonly style='resize: none;'  id='titulo'align='left'>" + element.title + "</textarea><br/><br/></div></div>"; //Aqui vai ficar o titulo ou a descrição.

        times+=1;
        //Aqui ira criar a postagem de seguir nova!! (a cada 17 postagens 1 será de seguir)----->
      }


      //------
    });

    document.getElementById("outputDiv").innerHTML += image;
    times = 0;
  }
  function Feed() {
    if (document.getElementById('j1')) {
        j=3;
        LoadFeed();
        //alert('j1 detectado');
    }
    else{
       document.getElementById("outputDiv").innerHTML += "<h2 class='post'> Olha o que encontramos para você 🧡</h2>"
    for(i=0; i <= Recomendados.length-1; i++){
    Stringval = Recomendados[i];
    JavaScriptFetch();
    }
}
  }

  //Esse feed será após visualizar os "recomendados", então ele vai carregar coisas genéricas e palavras muito buscadas (pois são colodas novas imagens todos os dias, evitando a pagina carregar coisas que você ja viu...)
  // Por enquanto o sistema é por aleatoridade, mas depois vai ficar tipo o do twitter
  function LoadFeed(){
    //Gerar 1 frase aleatória em português

    if(document.getElementById("followinpt").value != ''){
      document.getElementById("favoritosform").click();
    }
    if (document.getElementById('j1')) {
        j=3;
        //alert('j1 detectado');
    }
    if(j < 2){
     document.getElementById("outputDiv").innerHTML += "<div class='post'><h1>Por hoje é tudo!</h1><hr><h2>Cookies deixados por outros usuários 🍪</h2></div>"
     j++;
    }
    Destruir();
    for(i = 0; i<8; i++){
          //Gerar 1 frase em português
    var things = ['Engraçad', 'Legal', 'Bonit', 'Gosto', 'Casa', 'Feliz', 'Tumblr', 'Belo', ' ', ' ', ' '];
    var things2 = ['Viagem', 'Comida', 'Arte', 'Gatinho','Gato','Cachorro', 'Paisage', 'Tumblr', 'Livro', 'Musica', 'Game', 'Explore', 'Videos', 'Nature', 'Prédios', 'Céu', 'Ocean', 'Animais', 'Bichos',' ', ' ', ' '];
    //Gerar 1 frase em ingles
    var things3 = ['Funny', 'Nice', 'Beutifu', 'Happy', 'Home', 'Cool', 'Tumblr','', 'Beuty', 'little', ' ', ' ', ' '];
    var things4 = ['Trip', 'Food', 'Art', 'Cat', 'Fantastic','Dog', 'landscape', 'Tumblr', 'Book', 'Music', 'Game', 'Explore', 'Videos', 'Nature', 'Sky', 'Ocean', 'Cute', 'journey',' ', ' ', ' '];
    var phrase = [things2[Math.floor(Math.random()*things.length)] + ' ' + things[Math.floor(Math.random()*things.length)], things4[Math.floor(Math.random()*things.length)] + ' ' + things3[Math.floor(Math.random()*things.length)]];
    Stringval = phrase[generateRandomInteger(0,1)];
    if(y > 13 && j>=1){
      document.getElementById("outputDiv").innerHTML += "<p class='post' id='seguir'><br/>#"+ Stringval + "<i type='submit'id='followbutton' class='fas fa-heart' onclick='followbutton(this);'></i></p> "
    y = 0;
    }
    JavaScriptFetch();
        y++
  }
      $("body").scrollTop(0);
  }

  function generateRandomInteger(min, max) {
  return Math.floor(min + Math.random()*(max + 1 - min))
}

function search(){
  Stringval= document.getElementById("search").value;
  Destruir();
  times=-10;
  j=1;
  JavaScriptFetch();
  Stringval = Stringval.toLowerCase();
  if(Stringval == 'ass' || Stringval == 'dick' || Stringval == 'deputado federal' || Stringval == 'bunda' || Stringval == 'gostosa' || Stringval == 'penis'|| Stringval == 'pedo'|| Stringval == 'pedofilia'|| Stringval == 'zoofi'|| Stringval == 'zoofilia'|| Stringval == 'drugs'||Stringval == 'cannabis'||Stringval == 'maconha' ||Stringval == 'drogas'||Stringval == 'nacked'||Stringval == 'naked'||Stringval == 'nudes'||Stringval == 'nua'||Stringval == 'porn'||Stringval == 'porno'||Stringval == 'cu'||Stringval == 'anus'||Stringval == 'anal'||Stringval == 'puta'||Stringval == 'hentai'||Stringval == 'hentaii'||Stringval == 'instagram'||Stringval == 'facebook'||Stringval == 'twitter'){/*censurar palavras ofensivas*/
    alert('Esta palavra foi censurado por nossos editores e poderá resultar em punição');
}
  else{
    document.getElementById("outputDiv").innerHTML += "<p class='post' id='seguir'><br/>#"+ Stringval + "<i type='submit'id='followbutton' class='fas fa-heart' onclick='followbutton(this);'></i></p> "
  }}
function followbutton(x){
  x.style.color = "rgb(255, 84, 152)";
  x.style.backgroundColor = "rgba(171, 3, 149, 0.5)";
    x.classList.toggle("fa-cookie-bite");
  document.getElementById("followinpt").value = Stringval + ',';
}
function likebutton(x){
  x.style.color = "rgb(252, 222, 177)";
  x.classList.toggle("fa-cookie-bite");
}

$(document).ready(function () {
    $("#reset").click(function (e) {
        location.reload();
    });

    $("#submit").click(function (e) {
        $("#outputDiv").html("");
    });
});

//Detectar a altura da pagina e se ja chegou no fim da pagina (para carregar mais feed)
var j = 0;
$(window).scroll(function() {
   if($(window).scrollTop() + window.innerHeight == $(document).height()) {


     LoadFeed();
   }
});
//Limpar os posts antigos:
function Destruir() {
var elements = document.getElementsByClassName('post');
  while(elements.length > 1){
      elements[0].parentNode.removeChild(elements[0]);
  }
};
</script>
<br>
</fieldset>
</center>
</div>
</div>
<link rel="stylesheet" href="StylePrincipal.css" media="all" type="text/css">
</body>
</html>
<script language=JavaScript>
<!--

//Disable right mouse click Script
//By Geek Site.in


var message="Function Disabled!";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
//alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
//alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("return false")

// --> 
</script>
<?php

 ?>
