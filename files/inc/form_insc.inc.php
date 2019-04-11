<h1>Inscription</h1>
<form method="post" action="" autocomplete="off">
  <label>Pseudo : <br/><input class="centrer" type="text" name="pseudo" pattern="[A-Za-z]{3,20}" title="3 à 20 caractères lettres uniquement" placeholder="lettres uniquement min. 3"  required/></label><br/>
  <label>E-mail : <br/><input class="centrer" type="email" name="mail" placeholder="exemple@exemple.com" required/></label><br/>
  <label>Mot de passe : <br/><input class="centrer" type="password" name="passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Le mot de passe doit contenir au moins 6 caractères, 1 majuscule, une minuscule et 1 chiffre." placeholder="mot de passe" required/></label><br/>
  <label>Confirmation du mot de passe : <br/><input class="centrer" type="password" name="passe2" placeholder="confirmer mot de passe" required/></label><br/><br/>
  <input type="submit" name="ins" value="M'inscrire"/>
</form><br/>

<?php
include_once "files/inc/function.php";
if (!empty($_POST['ins']) && $_POST['mail'] && $_POST['passe'] == $_POST['passe2']) {
    // verifi pseudo existant en bdd
    $_POST['pseudo'] = htmltrim($_POST['pseudo']);
    $pseudo = addslashes($_POST['pseudo']);
    
    $result = executeRequete("SELECT username FROM user WHERE username='$pseudo'");
    //var_dump($result);
    
    if (mysqli_num_rows($result) == 0) { // retourne false, 0 row détécté, inscris le memebre et retourne true
        $_POST['passe'] = htmltrim($_POST['passe']);
        $_POST['passe'] = addslashes($_POST['passe']);
        $pass = $_POST['passe'];
        $password_hash = password_hash($pass, PASSWORD_DEFAULT); // passage mot de passe en crypté
        executeRequete("INSERT INTO user (id_user, username, password, e_mail, photo, humeur, description, centre_interet) VALUES 
        (NULL, '$pseudo ', '$password_hash', '$_POST[mail]', 'no-photo.jpg', NULL, NULL, NULL)") OR DIE($mysqli->error);
        // creation fiche user
        $val = 'Vous êtes bien inscrit, un mail arriveras sous peux à l\'adresse email inscite.';
    }
    if (mysqli_num_rows($result) != 0) { // si le nombre de row est autre que 0, l'utilisateur existe et génére une erreur
        $err = 'Un membre portant le pseudo "' . $pseudo . '" existe déjà !';
    }
}
if (!empty($_POST['ins']) && $_POST['passe'] != $_POST['passe2']) { // si les mots de passe ne sont pas identique, génére une erreur
    $err = 'Les mots de passe ne correspondent pas.';
}

?>