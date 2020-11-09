<?php
session_start();
if (empty($_SESSION['username'])){
    header('Location:../index.php');
}


$db= new PDO('mysql:host=127.0.0.1;dbname=tchat_test;charset=utf8',"root","");

if(isset($_POST['message']) AND !empty($_POST['message']))
{

    $pseudo = htmlspecialchars($_SESSION['username']);
    $message = htmlspecialchars($_POST['message']);
    $actual_date = date("Y-m-d H:i:s");
    $insertmsg = $db -> prepare('INSERT INTO tchat(pseudo,message,date_message) VALUES(?,?,?)');
    $insertmsg -> execute(array($_SESSION['username'],$message,$actual_date));
}

?>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de test Tchat</title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../javascript/reload.js"></script>
</head>
<body>
    <div id="container_messages"></div>
    <form id="container_send_messages" method="post" action="">
        <div>Vous êtes connecté en tant que: <?php echo $_SESSION['username']?></div>
        <input type="text" name="message" placeholder = "Ecris ton message ici !"></textarea>
        <input type="submit" value="Envoie"/>
        <a href="deconnexion.php">Se déconnecter</a>
    </form>

    
    
</body>

</html>