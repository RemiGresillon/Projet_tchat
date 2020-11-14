<?php

$db= new PDO('mysql:host=127.0.0.1;dbname=tchat_test;charset=utf8',"root","");

$error_on_pseudo = "";
$error_on_password = "";
$error_on_password_confirm = "";
$error_on_secret = "";
$error = "";



if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty(trim($_POST['pseudo']))){
        $error_on_pseudo = "Aucun pseudo";
    } else {
        $sql_request = "SELECT id FROM users WHERE pseudo= :pseudo";
        if($testing = $db -> prepare($sql_request)){
            $testing -> bindParam(":pseudo",$param_pseudo,PDO::PARAM_STR);
			$param_pseudo = trim($_POST["pseudo"]);
			if($testing->execute()){
                if ($testing -> rowCount() == 1){
                    $error_on_pseudo = "Ce pseudo est déjà pris, pourquoi ne pas essayer : " . trim($_POST["pseudo"]) . rand(10,999);
                } else {
                    $pseudo = trim($_POST["pseudo"]);
                }
            } else {
                $error = "Veuillez réessayer";
            }
        }
        unset($testing);
    }

    if(empty(trim($_POST['password']))){
        $error_on_password = "Veuillez donner un mot de passe";
    }

    if(empty(trim($_POST['confirm']))){
        $error_on_password_confirm = "Veuillez rentrer un mot de passe de confirmation";
    } else {
        if(empty($error_on_password) AND (trim($_POST['confirm']) != (trim($_POST['password'])))){
            $error_on_password_confirm = "Veuillez renseigner le même mot de passe";
        }
    }

    if(empty(trim($_POST['answer']))){
        $error_on_secret = "Veuillez renseigner une réponse à votre question secrète";
    }



    if(empty($error_on_password) AND empty($error_on_pseudo) AND empty($error_on_password_confirm) AND empty($error_on_secret)){
        $sql_request = "INSERT INTO users(pseudo,password,secret_question,secret_answer) VALUES (:pseudo,:password,:secret_question,:secret_answer)";
        $pseudo = trim($_POST['pseudo']);
        $password = trim($_POST['password']);
        $secret = trim($_POST['secret']);
        $answer = trim($_POST['answer']);
        if($statement = $db -> prepare($sql_request)){
            $statement -> bindParam(":pseudo",$pseudo,PDO::PARAM_STR);
            $statement -> bindParam(":password",$password,PDO::PARAM_STR);
            $statement -> bindParam(":secret_question",$secret,PDO::PARAM_STR);
            $statement -> bindParam(":secret_answer",$answer,PDO::PARAM_STR);
            if($statement->execute()){
                header("location:../index.php");
            } else {
                echo "Veuillez réessayer";
            }        
        }
        unset($statement);
    }
}

?>



<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de test Tchat</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="script" href="../js/reload.js">
</head>

<body>



<form id="container_login" method="post">
	<p>
		<h3>Créé ici ton propre compte ! </h3><br>
		<div class="content_login">
			<label> - Quel pseudo désires tu ? - </br><input type="text" name="pseudo"/></label></p>
            <?php echo $error_on_pseudo?>
		</div>
	</p>
	<p>
		<div class="content_login">
			<label> - Quel est ton mot de passe ? - </br><input type="password" name="password"/></label></p>
            <?php echo $error_on_password?>
		</div>
	</p>
    <p>
		<div class="content_login">
			<label> - Réécris ton mot de passe - </br><input type="password" name="confirm"/></label></p>
            <?php echo $error_on_password_confirm?>
		</div>
	</p>

    <p>
		<div class="content_login">
			<label> - Choisi une question secrète - </br>
                <select name="secret" size="1">
                    <option>Dans quelle ville êtes-vous né ? 
                    <option>Quelle est votre série préférée ? 
                    <option>Quelle est votre couleur favorite ? 
                </select>
                <input type="text" name="answer"/>
            </label></p>
            <?php echo $error_on_secret?>
		</div>
	</p>


	<p>
		<div class="content_login">
			<input class="submit" type="submit" value="Creation du compte"/>
            <a href="../index.php">J'ai déjà un compte</a></p>
            <?php echo $error?>
		</div>
	</p>
</form>




</body>

</html>