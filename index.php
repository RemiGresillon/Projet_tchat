<?php

$db= new PDO('mysql:host=127.0.0.1;dbname=tchat_test;charset=utf8',"root","");
$error_on_password = "";
$error_on_pseudo = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty(trim($_POST['pseudo']))){
		$error_on_pseudo = "Vos identifiants de connexion sont incorrect";
    } else {
        $pseudo = htmlspecialchars($_POST['pseudo']);
    }

    if(empty(trim($_POST['password']))){
        $error_on_password = "Vos identifiants de connexion sont incorrect";
    } else {
		$password = htmlspecialchars($_POST['password']);
    }


    if(empty($error_on_pseudo) AND empty($error_on_password)){
        $sql_request = "SELECT id,pseudo,password FROM users WHERE pseudo = :pseudo";
		if($testing = $db ->prepare($sql_request)){
			$testing -> bindParam(":pseudo",$param_pseudo,PDO::PARAM_STR);
			$param_pseudo = trim($_POST["pseudo"]);
			if($testing->execute()){
				if ($testing -> rowCount() == 1){
					if($user_data = $testing->fetch()){
						$user_id = $user_data["id"];
						$user_pseudo = $user_data["pseudo"];
						$user_password = $user_data["password"];
						if($password == $user_password){
							session_start();
							$_SESSION['loggedin'] = true;
							$_SESSION['id'] = $user_id;
							$_SESSION['username'] = $user_pseudo;
							header("Location: script/tchat.php");
						}
						else{
							$error_on_password = "Mot de passe invalide.";
						}
					}
				}
				else{
					$error = "Vos identifiants de connexion sont incorrect";
				} 

			}
		}
        unset($testing);
    }
	unset($db);
}
?>



<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de test Tchat</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="script" href="js/reload.js">
</head>

<body>


<form id="container_login" method="post">
	<p>
		<h3>Connecte toi au tchat :</h3><br>
		<div class="content_login">
			<label> - Pseudo - </br><input type="text" name="pseudo"/></label></p>
            <?php echo $error_on_pseudo?>
		</div>
	</p>
	<p>
		<div class="content_login">
			<label> - Mot de passe - </br><input type="password" name="password"/></label></p>
            <?php echo $error_on_password?>
		</div>
	</p>
	<p>
		<div class="content_login">
			<input class="submit" type="submit" value="Connexion"/>
			<a href="script/subscribe">Je n'ai pas de compte</a></p>
			<a href="script/reset_password">J'ai oublié mon mot de passe</a>
            <?php echo $error?>
		</div>
	</p>
</form>
</body>

</html>