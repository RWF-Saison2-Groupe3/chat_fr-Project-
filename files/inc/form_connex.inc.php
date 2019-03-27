<h1>Connexion</h1>
<form method="post" action="#">
  <label>Pseudo : <br/><input type="text" name="cn_pseudo" required/></label><br/>
  <label>Mot de passe : <br/><input type="password" name="cn_passe" required/></label><br/><br/>
  <a href="oubliemdp.php">Mot de passe oublié ?</a><br/><br/>
  <input type="checkbox" name="remember"><label>Se souvenir de moi</label><br/><br/>
  <input type="submit" id="cnn" name="cnn" value="Connexion"/>
</form>

<?php
//connexion auto si cookies
if(!isset($_SESSION['membre']) AND isset($_COOKIE['username'],$_COOKIE['password']) AND !empty($_COOKIE['username']) AND !empty($_COOKIE['password'])){
  $req1 = "SELECT * FROM user WHERE username='$_COOKIE[username]'";
  $result = $mysqli->query($req1);
  $conf_userC = $result->fetch_assoc();
  if($conf_userC && $_COOKIE['password'] == $conf_userC['password']){
  session_start(); 
  foreach ($conf_userC as $indice => $element){ // create aray avec toute les valeurs
    if($indice != 'password'){
      $_SESSION['membre'][$indice] = $element;
     }
    }
  }
  header('location: membre.php'); 
  exit(); // stop le traitement
}
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
      if(isset($_POST['remember'])){
        setcookie('username',$conf_user['username'],time()+365*24*3600,null,null,false,true);
        setcookie('password',$conf_user['password'] ,time()+365*24*3600,null,null,false,true);
      }
      foreach ($conf_user as $indice => $element){ // create array avec toute les valeurs
        if($indice != 'password'){
          $_SESSION['membre'][$indice] = $element;
        }
      }
  header('refresh: 0; url=verif.php'); // permet
  exit(); // permet de stoper l'execution du code a cette endroit ( pas besoins du reste )
}
  else{
    // si le couple user mdp n'existe pas, renvoie une erreur
    $errco = 'Erreur, verifier les données inscrites.';
  }
}
?>
