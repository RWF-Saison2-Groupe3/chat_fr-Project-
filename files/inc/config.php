<?php
// connection bdd
$servername = "localhost";
$serv_username = "root";
$serv_password = "admin";
$dbname = "chat_fr";

$mysqli = new Mysqli($servername, $serv_username, $serv_password, $dbname) OR DIE ($mysqli->error);
