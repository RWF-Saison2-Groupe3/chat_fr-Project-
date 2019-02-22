<?php
  session_start();
if (!empty($_SESSION['pseudo'])) // redirige a l'index si pas co --> fin en bas de page
{
  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';
  include_Once 'files/inc/nav.inc.php';
?>
<div class="grid-1">
<h1 class="profilName">Profil de <?php echo $_SESSION['pseudo'] ?></h1>
</div>
<div class="grid-10_">-</div>
<div class="grid-10 centrer">
  <div class="photoP"> <!-- affichage -->
  <img src="files/upload/<?php
  if($_SESSION['photo'] != ""){
    $photo = $_SESSION['photo'];
  }
  else{
    $photo = "no-photo.jpg";
  }
  echo $photo; ?>" alt="photo de profil"></div>
  <br/><span>Photo de profil : ( JPG, PNG | max. 2 mo)<br/><br/></span>
  <!-- PARTIS ENVOIE FICHIER AVATAR -->
<form method="POST" action="files/inc/traitement.php" enctype="multipart/form-data">
  <input type="file" name="avatar" accept="image/jpg, image/png">
  <input type="submit" name="envoie" value="envoyer">
  <input type="submit" name="clear" value ="✗">
</form>
</div>
<div class="grid-10_">-</div>
<div class="grid-1">fzefez</div>



<?php
    include_Once 'files/inc/footer.inc.php';
}
  else{
  header('Location: index.php');
  }
?>
