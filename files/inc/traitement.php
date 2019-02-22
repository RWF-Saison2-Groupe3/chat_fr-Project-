<link rel="stylesheet" href="../css/css.css">
<?php
session_start();
include_Once 'header.inc.php';
include_Once 'config.php';
$id = $_SESSION['id'];
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
     header('refresh: 1; url=../../profil.php');
}
if(!isset($result)) // pas d'erreur, on upload
{
     //Supprimer les accent et remplacer par des tirets
     $fichier = preg_replace('/&(.)(.*?);/', '$1', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) // bolléen -> true ça passe
     {
          $fichier = ($_FILES["avatar"]["name"]);
          $result = 'Upload effectué avec succès ! Retour a la page précédente...';
          unset($_SESSION['photo']);
        //  $mysqli->query("SELECT photo FROM user");
        //  $mysqli->query("INSERT INTO user (id_user, username, password, e_mail, photo, humeur, description, centre_interet) VALUES (NULL, '', '', '','$fichier', '', '', '') WHERE id_user=$id") OR DIE ($mysqli->error);
          $mysqli->query("UPDATE user SET photo='$fichier' WHERE id_user=$id");
          $_SESSION['photo'] = $fichier;
          header('refresh: 1; url=../../profil.php');
     }
     else //false ça passe pas
     {
          $result = 'Echec de l\'upload ! Retour a la page précédente...';
          header('refresh: 1; url=../../profil.php');
     }
}
else
{
     echo $erreur;
}}

/*              SUPP PHOTO               */
if(isset($_POST['clear'])){
  $result = 'Photo supprimer avec succés ! Retour à la page précédente...';
  unset($_SESSION['photo']);
  $mysqli->query("UPDATE user SET photo=NULL WHERE id_user=$id");
  header('refresh: 1; url=../../profil.php');
}


?>

<!--AFFICHAGE  -->
<div class="grid-1 center">
  <h1><?php echo $result ?></h1>
<img src="../img/loading.gif" alt="chargement..">
</div>
<?php   include_Once 'footer.inc.php'; ?>
