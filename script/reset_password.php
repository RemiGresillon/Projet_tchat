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
                if ($testing -> rowCount() == 0){
                    $error_on_pseudo = "Ce pseudo n'existe pas";
                } else{
                    $pseudo = trim($_POST["pseudo"]);
                }
            }
            unset($testing);
        }
    }

    if(empty(trim($_POST['answer']))){
        $error_on_secret = "Veuillez renseigner une réponse";
    } else {
    $sql_request = "SELECT id FROM users WHERE pseudo = :pseudo AND secret_question = :secret_question AND secret_answer = :secret_answer";
        if($statement = $db -> prepare($sql_request)){
            $statement -> bindParam(":pseudo",$pseudo,PDO::PARAM_STR);
            $statement -> bindParam(":secret_question",$secret,PDO::PARAM_STR);
            $statement -> bindParam(":secret_answer",$answer,PDO::PARAM_STR);
            $pseudo = trim($_POST["pseudo"]);
            $secret = trim($_POST['secret']);
            $answer = trim($_POST['answer']);
            if($statement->execute()){
                if ($statement -> rowCount() == 0){
                    $error_on_secret = "La réponse et/ou la question ne convienne pas au pseudo";
                }
            }
            else {
                $error_on_secret = "Erreur générale";
            }
            unset($statement);
        }
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


    if(empty($error_on_secret) AND empty($error_on_pseudo) AND empty($error_on_password) AND empty($error_on_password_confirm)){
        $sql_request = "UPDATE users SET password = :password WHERE pseudo =:pseudo";
        if($statement = $db -> prepare($sql_request)){
            $statement -> bindParam(":password",$password,PDO::PARAM_STR);
            $statement -> bindParam(":pseudo",$pseudo,PDO::PARAM_STR);
            $password = trim($_POST["password"]);
            if ($statement->execute()){
                header("location:../index.php");
            } else {
                echo "Veuillez réessayer";
            }
        }
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
            <h3>Avec ta question secrète met à jour ton mot de passe !</h3><br>
                <div class="content_login">
                    <label> - Quel est ton pseudo ? - </br><input type="text" name="pseudo"/></label></p>
                    <?php echo $error_on_pseudo?>
                </div>
        </p>
        <p>
            <div class="content_login">
                <label> - Quelle est ta question secrète ? - </br>
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
                <label> - Quel est ton nouveau mot de passe ? - </br><input type="password" name="password"/></label></p>
                <?php echo $error_on_password?>
            </div>
	    </p>
        <p>
            <div class="content_login">
                <label> - Réécris ton mot de passe - </br><input type="password" name="confirm"/></label></p>
                <?php echo $error_on_password?>
            </div>
	    </p>
        <p>
            <div class="content_login">
                <input class="submit" type="submit" value="Mettre à jour"/>
                <a href="../index.php">Je me souviens de mon mot de passe !</a></p>
                <?php echo $error?>
            </div>
	    </p>
    </form>
</body>
</html>
