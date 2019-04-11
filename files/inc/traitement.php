<link rel="stylesheet" href="../css/css.css">
<?php
session_start();
include_Once 'header.inc.php';
include_Once 'function.php';
include_Once 'config.php';

if(!connecter()){
     header('location: connexion.php');
     exit();

}
$id = $_SESSION['membre']['id_user'];

/* --------------------------------------------------------------------- */

/*                             PROFIL                                    */

/* --------------------------------------------------------------------- */

if (isset($_POST['updateProfil'])) {

     /* ----------------------------- */
     /*              UPLOAD PHOTO     */
     /* ----------------------------- */
     if (!empty($_FILES['avatar'])) {

          $dossier = '../../files/upload/';
          $fichier = basename($_FILES['avatar']['name']);
          $extensions = array('.jpg','.png','.JPG', '.jpeg');
          $extension = strrchr($_FILES['avatar']['name'], '.');
          // secu extension

               if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau

                    $result = 'Vous devez uploader un fichier de type jpg ou png. Retour a la page précédente...';
                    header('refresh: 1; url=../../profil.php?id='.$id.'');

               }
          if (!isset($result)) { // pas d'erreur, on upload

                //refactoring titre image
               $fichier = preg_replace('/&(.)(.*?);/', '$1', $fichier);

               if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) { // bolléen -> true ça passe
          
                    $fichier = ($_FILES["avatar"]["name"]);
                    $result = 'Profil mis à jour avec succés !';
                    unset($_SESSION['membre']['photo']);
                    executeRequete("UPDATE user SET photo='$fichier' WHERE id_user=$id");
                    $_SESSION['membre']['photo'] = $fichier;
                    header('refresh: 1; url=../../profil.php?id='.$id.'');
                } else { //false ça passe pas
          
               $result = 'Echec de l\'upload ! Retour a la page précédente...';
               header('refresh: 1; url=../../profil.php?id='.$id.'');

               }
          }
     }
     /* ----------------------------- */
     /*              MAJ HUMEUR       */
     /* ----------------------------- */
     if (isset($_POST['humeur'])) {
          $result = 'Profil mis à jour avec succés !';
          $_POST['humeur'] = htmltrim($_POST['humeur']);
          $_POST['humeur'] = addslashes($_POST['humeur']);
          $hum = $_POST['humeur'];
          executeRequete("UPDATE user SET humeur='$hum' WHERE id_user=$id");
          $_SESSION['membre']['humeur'] = $hum; // update la session
          header('refresh: 1; url=../../profil.php?id='.$id.'');
   } else {
        $result = "Une erreur est survenue.";
    }
     /* ----------------------------- */
     /*              MAJ INTERET      */
     /* ----------------------------- */

     if (isset($_POST['int'])) {
          $result = 'Profil mis à jour avec succés !';
          $_POST['int'] = htmltrim($_POST['int']);
          $_POST['int'] = addslashes($_POST['int']);
          $int = $_POST['int'];
          executeRequete("UPDATE user SET centre_interet='$int' WHERE id_user=$id");
          $_SESSION['membre']['centre_interet'] = $int; // update la session
          header('refresh: 1; url=../../profil.php?id='.$id.'');
     } else {
          $result = "Une erreur est survenue.";
      }
     /* ----------------------------- */
     /*              MAJ DESCRIPTION  */
     /* ----------------------------- */
     if (isset($_POST['description'])) {
          $result = 'Profil mis à jour avec succés !';
          $_POST['description'] = htmltrim($_POST['description']);
          $_POST['description'] = addslashes($_POST['description']);
          $desc = $_POST['description'];
          executeRequete("UPDATE user SET description='$desc' WHERE id_user=$id");
          $_SESSION['membre']['description'] = $desc;
          header('refresh: 1; url=../../profil.php?id='.$id.'');
     } else {
          $result = "Une erreur est survenue.";
      }
}

/*--------------SUPP PHOTO --------------*/
if (!empty($_POST['clear'])) {
     $result = 'Photo supprimer avec succés ! Retour à la page précédente...';
     unset($_SESSION['membre']['photo']);
     $_SESSION['membre']['photo'] = 'no-photo.jpg';
     executeRequete("UPDATE user SET photo='no-photo.jpg' WHERE id_user=$id");
     header('refresh: 1; url=../../profil.php?id='.$id.'');
}

/* --------------------------------------------------------------------- */

/*                             SETTING                                  */

/* --------------------------------------------------------------------- */


/* CHANGEMENT DE MOT DE PASSE USER */
if(!empty($_POST['chd_pass'])&& !empty($_GET['id']) && !empty($_POST['chd_pass']) && $_POST['chd_pass'] == $_POST['chd_pass_repeat']){
     if($_GET['id'] == $_SESSION['membre']['id_user']){ //si l'id en url est l'id de l'utilisateur connecté
          $id = $_GET['id'];
          $_POST['chd_pass'] = htmltrim($_POST['chd_pass']);
          $_POST['chd_pass'] = addslashes($_POST['chd_pass']);
          $pass = $_POST['chd_pass'];
          $password_hash = password_hash($pass, PASSWORD_DEFAULT); // passage mot de passe en crypté
          executeRequete("UPDATE user SET password='$password_hash' WHERE id_user=$id");
               if(isset($_COOKIE['password'])){
                    setcookie("password", $password_hash, time()+3600, '/Chat_fr');
               }
          $result = 'Mot de passe modifié avec succé !';
          header('refresh: 1; url=../../setting.php?id='.$id.'');
     }else{ //Si l'id en url n'est pas l'id de la session
          $id = $_SESSION['membre']['id_user'];
          $result = "Une erreur est survenue.";
          header('refresh: 1; url=../../setting.php?id='.$id.'');
     }
}

/* SUPPRESSION DE COMPTE UTILISATEUR */

if(!empty($_POST['suppr_compte'])){
     if(!empty($_GET['id'])){
          if($_GET['id'] == $_SESSION['membre']['id_user']){
               $id = $_GET['id'];

               $hashbd = executeRequete("SELECT password FROM user WHERE id_user=$id");
               $hashbdd = $hashbd->fetch_assoc();
               if (password_verify($_POST['suppr_pass'], $hashbdd['password'])) {

                    $req1 = executeRequete("DELETE FROM user WHERE id_user=$id");
                    $req2 = executeRequete("DELETE FROM amis WHERE id_m_demandeur=$id OR id_m_receveur=$id");
                    $_SESSION = array();
                    session_destroy();
                    if(!empty($_COOKIE['username'])){
                         // cookie firefox
                         setcookie("username", '', time()-3600, '/Chat_fr/');
                         setcookie("password", '', time()-3600, '/Chat_fr/');
                         // cookie chrome
                         setcookie("username", '', time()-3600, '/Chat_fr');
                         setcookie("password", '', time()-3600, '/Chat_fr');
                    }
                    header('Location: ../../index.php?action=del');
               }else{
                    $id = $_SESSION['membre']['id_user'];
                    $result = "Le mot de passe n'est pas bon";
                    header('refresh: 1; url=../../setting.php?id='.$id.'');
               }
          }else{
               $id = $_SESSION['membre']['id_user'];
               $result = "Une erreur est survenue.";
               header('refresh: 1; url=../../setting.php?id='.$id.'');
          }
     } else {
          $id = $_SESSION['membre']['id_user'];
          $result = "Une erreur est survenue.";
          header('refresh: 1; url=../../setting.php?id='.$id.'');
     }
}
/* MESSAGE ALL OR NOT */
if (isset($_POST['swichFriend'])) {
     if (!empty($_GET['id'])) {
          if($_GET['id'] == $_SESSION['membre']['id_user']){
               $id = $_GET['id'];
               $test = executeRequete("SELECT all_mess FROM user WHERE id_user=$id");
               $res = $test->fetch_assoc();
               
               if ($res['all_mess'] == 0) {
                    executeRequete("UPDATE user SET all_mess=1 WHERE id_user=$id");
                    $result = "Modifié avec succés.";
                    header('refresh: 1; url=../../setting.php?id='.$id.'');
               }

               if ($res['all_mess'] == 1){
                    executeRequete("UPDATE user SET all_mess=0 WHERE id_user=$id");
                    $result = "Modifié avec succés.";
                    header('refresh: 1; url=../../setting.php?id='.$id.'');
               }
               
          } else {
               $id = $_SESSION['membre']['id_user'];
               $result = "Une erreur est survenue.";
               header('refresh: 1; url=../../setting.php?id='.$id.'');
          }
     } else {
          $id = $_SESSION['membre']['id_user'];
          $result = "Une erreur est survenue.";
          header('refresh: 1; url=../../setting.php?id='.$id.'');
     }
}

?>






<!--AFFICHAGE  -->
<div class="grid-1 center">
  <h1><?php if(!empty($result)) echo $result ?></h1>
<img src="../img/loading.gif" alt="chargement..">
</div>
<?php   include_Once 'footer.inc.php'; ?>
