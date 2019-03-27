<h1>Inscription</h1>
<form method="post" action="#">
  <label>Pseudo : <br/><input class="centrer" type="text" name="pseudo" pattern=".{3,20}" title="3 à 20 caractères" placeholder="20 caractères maxiumum" required/></label><br/>
  <label>E-mail : <br/><input type="email" name="mail" required/></label><br/>
  <label>Mot de passe : <br/><input type="password" name="passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit contenir au moins 6 caractères, 1 majuscule, une minuscule et 1 chiffre."required/></label><br/>
  <label>Confirmation du mot de passe : <br/><input type="password" name="passe2" required/></label><br/><br/>
  <input type="submit" name="ins" value="M'inscrire"/>
</form><br/>

<?php

  // inscription
if(!empty($_POST['ins']) && $_POST['mail'] && $_POST['passe'] == $_POST['passe2']){
  // verifi pseudo existant en bdd
  $pseudo = $_POST['pseudo'];
  $sql_query = "SELECT username FROM user WHERE username='$pseudo'";
  $result = $mysqli->query($sql_query);
  //var_dump($result);

      if(mysqli_num_rows($result) == 0){ // retourne false, 0 row détécté, inscris le memebre et retourne true
            $pass = $_POST['passe'];
            $password_hash = password_hash($pass, PASSWORD_DEFAULT); // passage mot de passe en crypté
            $mysqli->query("INSERT INTO user (id_user, username, password, e_mail, photo, humeur, description, centre_interet) VALUES (NULL, '$pseudo ', '$password_hash', '$_POST[mail]', 'no-photo.jpg', NULL, NULL, NULL)") OR DIE ($mysqli->error);
            // creation fiche user
            $val = 'Vous êtes bien inscrit, un mail arriveras sous peux à l\'adresse email inscite.';
}
  if(mysqli_num_rows($result) != 0){ // si le nombre de row est autre que 0, l'utilisateur existe et génére une erreur
  $err = 'Un membre portant le pseudo "' .$pseudo. '" existe déjà !';
  }
}if(!empty($_POST['ins']) && $_POST['passe'] != $_POST['passe2']){ // si les mots de passe ne sont pas identique, génére une erreur
  $err = 'Les mots de passe ne correspondent pas.';
 }

?>
