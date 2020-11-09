<?php

    $db= new PDO('mysql:host=127.0.0.1;dbname=tchat_test;charset=utf8',"root","");

    $fetching_messages = $db -> query('SELECT * FROM tchat ORDER BY id');
    while($messages = $fetching_messages->fetch()){
        ?>
        <div id="bloc_message_left">
            <div id="date"><?php echo $messages['date_message'] ?></div>
            <div id="pseudo_message"><?php echo $messages['pseudo']?></div>
            <div id="text_message"><?php echo $messages['message']?></div>
        </div>
        <?php
    }
?>


