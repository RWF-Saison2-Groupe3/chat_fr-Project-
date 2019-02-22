<link rel="stylesheet" href="files/css/css.css">
<h1>Mot de passe oublié ?</h1>
<form method="post" action="#">
<label>E-mail de récupération :<br/><br/><input type="email" placeholder="Mail@domain.com" name="mail_recup" required/></label><br/><br/>
<input type="submit" name="recup" value="Envoyer"/>
</form><br/>
<?php
 if($_POST['recup']){
   $_POST['mail_recup'] = htmlentities (trim($_POST['mail_recup'],ENT_QUOTES)); // sécurisation
   $req = "SELECT * FROM user WHERE e_mail='$_POST[mail_recup]'";
   $result = $mysqli->query($req);
   //$val = 'requete debug : '.$req.'';
   //echo $val;
   $mail_use = $result->fetch_assoc();
   if($_POST['mail_recup'] = $mail_use){

      $mssg = 'l\'email est bon !';

      // script envoie mail récuperation mdp

      $mail_u = $_POST['mail_recup'];

      mail($mail_u, 'Reset password', $corps_mail);

      if(mail){
        $mssg = 'Mail envoyé à l\'adresse indiqué.';
      }


      /* ------------------------------------------------ */

      // formulaire envoie mail readline_completion_function

      //$corp_mail = $_POST['mail_recup'];
   }
   else{
     echo 'Aucun utilisateur n\'est enregistré avec cette adresse mail.<br/><br/>';
     echo 'Verifier les données saisie ou <a href="index.php">crée un compte.</a>';
   }
}
?>
