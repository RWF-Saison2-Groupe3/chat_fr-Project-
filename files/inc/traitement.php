<link rel="stylesheet" href="../css/css.css">
<?php
session_start();
include_Once 'header.inc.php';
include_Once 'config.php';
$id = $_SESSION['membre']['id_user'];
if(isset($_POST['envoie'])){
// traitement fichier envoyé -> avatar profil
/* ENVOIE FICHIER */
$dossier = '../../files/upload/';
$fichier = basename($_FILES['avatar']['name']);
$extensions = array('.png','.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.');
// secu
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $result = 'Vous devez uploader un fichier de type jpg ou png. Retour a la page précédente...';
     header('refresh: 1; url=../../profil.php?id='.$id.'');
}
if(!isset($result)) // pas d'erreur, on upload
{
     //Supprimer les accent et remplacer par des tirets
     $fichier = preg_replace('/&(.)(.*?);/', '$1', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) // bolléen -> true ça passe
     {
          $fichier = ($_FILES["avatar"]["name"]);
          $result = 'Upload effectué avec succès ! Retour a la page précédente...';
          unset($_SESSION['membre']['photo']);
        //  $mysqli->query("SELECT photo FROM user");
        //  $mysqli->query("INSERT INTO user (id_user, username, password, e_mail, photo, humeur, description, centre_interet) VALUES (NULL, '', '', '','$fichier', '', '', '') WHERE id_user=$id") OR DIE ($mysqli->error);
          $mysqli->query("UPDATE user SET photo='$fichier' WHERE id_user=$id");
          $_SESSION['membre']['photo'] = $fichier;
          header('refresh: 1; url=../../profil.php?id='.$id.'');
     }
     else //false ça passe pas
     {
          $result = 'Echec de l\'upload ! Retour a la page précédente...';
          header('refresh: 1; url=../../profil.php?id='.$id.'');
     }
}
else
{
     echo $erreur;
}}

/*              SUPP PHOTO               */
if(!empty($_POST['clear'])){
  $result = 'Photo supprimer avec succés ! Retour à la page précédente...';
  unset($_SESSION['membre']['photo']);
  $mysqli->query("UPDATE user SET photo=NULL WHERE id_user=$id");
  header('refresh: 1; url=../../profil.php?id='.$id.'');
}

/*               HUMEUR                     */
if(!empty($_POST['subHum'])){
     if(isset($_POST['humeur'])){
     $result = 'Message mis a jour avec succés !';
     $hum = $_POST['humeur'];
     $mysqli->query("UPDATE user SET humeur='$hum' WHERE id_user=$id");
     $_SESSION['membre']['humeur'] = $hum; // update la session
     header('refresh: 1; url=../../profil.php?id='.$id.'');
   }else{
        $result = "Une erreur est survenue.";
}}
/*           INTERETS                      */ 
if(!empty($_POST['subInt'])){
     if(isset($_POST['int'])){
     $result = 'Centres d\'intêret mis a jour avec succés !';
     $int = $_POST['int'];
     $mysqli->query("UPDATE user SET centre_interet='$int' WHERE id_user=$id");
     $_SESSION['membre']['centre_interet'] = $int; // update la session
     header('refresh: 1; url=../../profil.php?id='.$id.'');
   }else{
        $result = "Une erreur est survenue.";
}}
?>






<!--AFFICHAGE  -->
<div class="grid-1 center">
  <h1><?php echo $result ?></h1>
<img src="../img/loading.gif" alt="chargement..">
</div>
<?php   include_Once 'footer.inc.php'; ?>
