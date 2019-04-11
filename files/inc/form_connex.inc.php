<h1>Connexion</h1>
<form method="post" action="">
  <label>Pseudo : <br/><input class="centrer" type="text" name="cn_pseudo" autocomplete="off" required/></label><br/>
  <label>Mot de passe : <br/><input class="centrer" type="password" name="cn_passe" required/></label><br/><br/>
  <a href="oubliemdp.php">Mot de passe oublié ?</a><br/><br/>
  <input type="checkbox" name="remember"><label>Se souvenir de moi</label><br/><br/>
  <input type="submit" id="cnn" name="cnn" value="Connexion"/>
</form>

<?php
include_once "files/inc/function.php";

//connexion auto si cookies
if (!isset($_GET['action'])) {
    if (!isset($_SESSION['membre']) AND isset($_COOKIE['username'], $_COOKIE['password']) AND !empty($_COOKIE['username']) AND !empty($_COOKIE['password'])) {
        $result = executeRequete("SELECT * FROM user WHERE username='$_COOKIE[username]'");
        $conf_userC = $result->fetch_assoc();
        if ($conf_userC && $_COOKIE['password'] == $conf_userC['password']) {
            session_start();
            foreach ($conf_userC as $indice => $element) { // create array avec toute les valeurs
                if ($indice != 'password') {
                    $_SESSION['membre'][$indice] = $element;
                }
            }
        }
        header('location: index.php');
        exit(); // stop le traitement
    }
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'deco') {
        if (!empty($_COOKIE['username'])) {
            // cookie firefox
            setcookie("username", '', time() - 3600, '/Chat_fr/');
            setcookie("password", '', time() - 3600, '/Chat_fr/');
            // cookie chrome
            setcookie("username", '', time() - 3600, '/Chat_fr');
            setcookie("password", '', time() - 3600, '/Chat_fr');
        }
        header('location: index.php');
    }
    if ($_GET['action'] == 'del') {
        header('location: membre.php');
    }
}

if (isset($_POST['cn_pseudo']) && isset($_POST['cn_passe'])) {

    $_POST['cn_pseudo'] = htmltrim($_POST['cn_pseudo']);
    $_POST['cn_passe']  = htmltrim($_POST['cn_passe']); 


    $_POST['cn_pseudo'] = addslashes($_POST['cn_pseudo']); 
    $_POST['cn_passe']  = addslashes($_POST['cn_passe']); 

    $result = executeRequete("SELECT * FROM user WHERE username='$_POST[cn_pseudo]'");
    $conf_user = $result->fetch_assoc();
    // couple user mdp verif
    if ($conf_user && password_verify($_POST['cn_passe'], $conf_user['password'])) {
        // crée une session et redirige sur la page membre
        session_start();
        if (isset($_POST['remember'])) {
            setcookie('username', $conf_user['username'], time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('password', $conf_user['password'], time() + 365 * 24 * 3600, null, null, false, true);
        }
        foreach ($conf_user as $indice => $element) { // create array avec toute les valeurs
            if ($indice != 'password') {
                $_SESSION['membre'][$indice] = $element;
            }
        }
        header('refresh: 0; url=verif.php'); // permet
        exit(); // permet de stoper l'execution du code a cette endroit ( pas besoins du reste )
    } else {
        // si le couple user mdp n'existe pas, renvoie une erreur
        $errco = 'Erreur, verifier les données inscrites.';
    }
}
?>