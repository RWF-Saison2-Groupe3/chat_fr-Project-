<?php
  echo $val;
  echo $erreur;



 //test var hash
 $has = password_hash($pass, PASSWORD_DEFAULT);
  // variable de session

  $_SESSION['username'] = $_POST['cn_pseudo'];



  // variabel mail

  $corps_mail = "Bonjour, vous avez fait une requete de réinisialiasation de mot de passe.";
  $corps_mail = wordwrap($corps_mail, 70, "\r\n");
?>
