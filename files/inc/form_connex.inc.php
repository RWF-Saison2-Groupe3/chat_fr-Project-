<h1>Connexion</h1>
<form method="post" action="#">
<label>Pseudo : <br/><input type="text" name="cn_pseudo" required/></label><br/>
<label>Mot de passe : <br/><input type="password" name="cn_passe" required/></label><br/><br/>
<a href="oubliemdp.php">Mot de passe oublié ?</a><br/><br/>
<input type="submit" id="cnn" name="cnn" value="Connexion"/>
</form>

<?php
  //  si form connexion envoyé et champs remplis
if (isset($_POST['cn_pseudo']) && isset($_POST['cn_passe'])){

  // predefinistion variables & sécurité

  $_POST['cn_pseudo'] = htmlentities (trim($_POST['cn_pseudo'],ENT_QUOTES)); // htmlentities entquotes & trim securité
  $_POST['cn_passe'] = htmlentities (trim($_POST['cn_passe'],ENT_QUOTES)); // envite les injection sql

  // selection table correspondante a l'username rentrée dans le formulaire
  $req = "SELECT * FROM user WHERE username='$_POST[cn_pseudo]'";
  $result = $mysqli->query($req);

  //$val = 'requete debug : '.$req.''; //----------DEBUGREQUEST affiche requete envoyé
  $conf_user = $result->fetch_assoc();
  //var_dump($_POST);                  //           DEBUGREQUEST affiche tout les infos

// verifi si l'utilsateur et le mot de passe corresponde, mot de passe et mot de passe hash en bdd
if ($conf_user && password_verify($_POST['cn_passe'], $conf_user['password'])){
  // si le couple user mdp existe --> crée une session et redirige sur la page membre
      session_start();
      $_SESSION['id'] = $conf_user['id_user'];
      $_SESSION['pseudo'] = $conf_user['username'];
      $_SESSION['mail'] = $conf_user['e_mail'];
      $_SESSION['photo'] = $conf_user['photo'];
      $_SESSION['humeur'] = $conf_user['humeur'];
      $_SESSION['desc'] = $conf_user['description'];
      $_SESSION['centre_interet'] = $conf_user['centre_interet'];
  // test cookies
  // non fonctionnel, placé en premier dans le code ??
  //$temps = 368*24*3600;
  //setcookie("pseudo", $_POST['cn_pseudo'],"password", $_POST['cn_passe'], time() + $temps);

  header('refresh: 0; url=verif.php'); // permet
  exit(); // permet de stoper l'execution du code a cette endroit ( pas besoins du reste )
}
else{
  // si le couple user mdp n'existe pas, renvoie une erreur
  $errco = 'Erreur, verifier les données inscrites.';
}
}

?>
