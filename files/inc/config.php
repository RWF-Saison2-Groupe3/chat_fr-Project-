<?php

// connection bdd + définition variables
$servername = "localhost";
$serv_username = "root";
$serv_password = "admin";
$dbname = "chat_fr";

$mysqli = new Mysqli($servername, $serv_username, $serv_password, $dbname) OR DIE ($mysqli->error);

// email webmaster
$mail_webmaster = 'example@example.com';

// url home
$home = 'index.php';

// nom du design

$design = 'default_Jonas';

?>
