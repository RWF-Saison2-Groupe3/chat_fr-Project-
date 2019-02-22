<h1>Inscription</h1>
<form method="post" action="#">
<label>Pseudo : <br/><input class="centrer" type="text" name="pseudo" pattern=".{3,20}" title="3 à 20 caractères" placeholder="20 caractères maxiumum" required/></label><br/>
<label>E-mail : <br/><input type="email" name="mail" required/></label><br/>
<label>Mot de passe : <br/><input type="password" name="passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit contenir au moins 6 caractères, 1 majuscule, une minuscule et 1 chiffre."required/></label><br/>
<label>Confirmation du mot de passe : <br/><input type="password" name="passe2" required/></label><br/><br/>
<input type="submit" name="ins" value="M'inscrire"/>
</form><br/>

<?php
// verifi pseudo bdd
  $pseudo = $_POST['pseudo'];
  $sql_query = "SELECT username FROM user WHERE username='$pseudo'";
  $result = $mysqli->query($sql_query);
  //var_dump($result);
// connexion
if($_POST['ins'] && $_POST['mail'] && $_POST['passe'] == $_POST['passe2']){
      if(mysqli_num_rows($result) == 0){ // retourne false, 0 row détécté, inscris le memebre et retourne true
            $pass = $_POST['passe'];
            $password_hash = password_hash($pass, PASSWORD_DEFAULT);
            $mysqli->query("INSERT INTO user (id_user, username, password, e_mail, photo, humeur, description, centre_interet) VALUES (NULL, '$pseudo ', '$password_hash', '$_POST[mail]', NULL, NULL, NULL, NULL)") OR DIE ($mysqli->error);
            // un seul utilisateur ne peux avoir le même Pseudo // Envoie e mail
            $val = 'Vous êtes bien inscrit, un mail arriveras sous peux à l\'adresse email inscite.';
      // envoi mail --> deplocage port 25 ?
      /*$mess = "test";
      $to      = 'jonas.bertindev@gmail.com';
      $subject = 'inscription Chat Fr';
      $message = utf8_decode($mess);
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: '.$_POST["mail"]. "\r\n" .
       'Reply-To: '.$_POST["mail"]. "\r\n" .
       'X-Mailer: PHP/' . phpversion(). "\r\n";
      $headers .= "Bcc: jonas.bertindev@gmail.com" . "\r\n";

      mail($to, $subject, $message, $headers); // actif on serveur wamp*/
}
  if(mysqli_num_rows($result) != 0){ // si le nombre de row est autre que 0, l'utilisateur existe et génére une erreur
  $err = 'Un membre portant le pseudo "' .$pseudo. '" existe déjà !';
  }
}
elseif($_POST['passe'] != $_POST['passe2']){
  $err = 'Les mots de passe ne correspondent pas.';
}
?>
