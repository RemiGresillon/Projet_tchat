<?php
session_start();
if (empty($_SESSION['username'])){
    header('Location:../index.php');
}

//$db= new PDO('mysql:host=127.0.0.1;dbname=tchat_test;charset=utf8',"root","");
?>

<script>
colorPicker.addEventListener("input", updateFirst, false);
colorPicker.addEventListener("change", watchColorPicker, false);


function watchColorPicker(event) {
  console.log(event.target.name)
  document.getElementById(event.target.name).style.backgroundColor = event.target.value;
  });
}

</script>



<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de test Tchat</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="container_messages_options">
        <div id="bloc_message_left_options">
            <div id="date">Date</div>
            <div id="pseudo_message">Pseudo autre utilisateur</div>
            <div id="text_message">Blablabla</div>
        </div>
        <div id="bloc_message_right_options">
            <div id="date">Date</div>
            <div id="pseudo_message">Votre pseudo</div>
            <div id="text_message">Blablabla</div>
        </div>
        <div id="bloc_message_left_options">
            <div id="date">Date</div>
            <div id="pseudo_message">Votre pseudo</div>
            <div id="text_message">Blablabla</div>
        </div>
        <div id="bloc_message_right_options">
            <div id="date">Date</div>
            <div id="pseudo_message">Votre pseudo</div>
            <div id="text_message">Blablabla</div>
        </div>
    </div>
    <form id="container_send_messages" method="post" action="">
        <p>
            <label for="colorWell">Fond du tchat:</label>
            <input type="color" value="#C0E1E4" id="colorWell_background">
        </p>
        <p>
            <label for="colorWell">Messages des autres utilisateurs:</label>
            <input type="color" value="#5B9094" id="colorWell_left">
        </p>
        <p>
            <label for="colorWell">Vos messages:</label>
            <input type="color" value="#22CAD6" id="colorWell_right">
        </p>
    </form>


<!--        <div>
            <input type="color" id="head" name="container_messages_options" value="#C0E1E4">
            <label for="head">Fond du tchat</label>
        </div>

        <div>
            <input type="color" id="body" name="bloc_message_left_options" value="#5B9094">
            <label for="body">Messages des autres utilisateurs</label>
        </div>

        <div>
            <input type="color" id="body" name="bloc_message_right_options" value="#22CAD6">
            <label for="body">Vos messages</label>
        </div>
        <input type="submit" value="Validation"/>-->



<script>

var colorWell;
var background_default = "#C0E1E4";
var left_default = "#5B9094";
var right_default = "#22CAD6";

window.addEventListener("load", startup_background, false);
window.addEventListener("load", startup_left, false);
window.addEventListener("load", startup_right, false);


function startup_background() {
  colorWell = document.querySelector("#colorWell_background");
  colorWell.value = background_default;
  colorWell.addEventListener("input", update_background, false);
  colorWell.addEventListener("change", updateAll, false);
  colorWell.select();
}
    
function startup_left() {
  colorWell = document.querySelector("#colorWell_left");
  colorWell.value = left_default;
  colorWell.addEventListener("input", update_left, false);
  colorWell.select();
}

function startup_right() {
  colorWell = document.querySelector("#colorWell_left");
  colorWell.value = right_default;
  colorWell.addEventListener("input", update_right, false);
  colorWell.select();
}

function update_background(event){
    var container = document.getElementById("container_messages_options");
    if (container){
        container.style.backgroundColor = event.target.value;
    }
}

function update_right(event){
    var right = document.getElementById("bloc_message_right_options");
    if (right){
        right.style.backgroundColor = event.target.value;
    }
}

function update_left(event){
    var left = document.getElementById("bloc_message_left_options");
    if (left){
        left.style.backgroundColor = event.target.value;
    }
}



function updateAll(event) {
  document.querySelectorAll("bloc_message_right_options").forEach(function(bloc_message_right_options) {
    bloc_message_right_options.style.color = event.target.value;
  });
}
</script>

    
</body>

</html>