<?php
session_start();
$_SESSION = array();
session_destroy();
if(!empty($_COOKIE['username'])){
setcookie("username", '', time()-3600, '/Chat_fr');
setcookie("password", '', time()-3600, '/Chat_fr');
}
//var_dump($_COOKIE);
header('Location: ../../index.php?action=deco');
//var_dump($_POST);
exit();
?>
