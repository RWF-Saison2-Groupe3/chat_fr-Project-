<?php
  session_start();
if (!empty($_SESSION['membre'])) // redirige a l'index si pas co --> fin en bas de page
{
  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';
  include_Once 'files/inc/nav.inc.php';
  // il faudrais arriver a définir une page pour un utilisatur ?
  //$test = $_SESSION['id']; --> me valide bien l'id de l'utilisateur en session
  //echo $test;
?>
<div class="grid-1" style="text-align: right;"><em><a style="margin-right: 40px;" href="view.php?id=<?php echo $_GET['id'] ?>">Voir mon profil</a></em></div>
<div class="grid-1 center">
<h1 class="profilName">Profil de <?php echo $_SESSION['membre']['username']; ?></h1>
</div>
<div class="grid-1 centrer">
  <div class="photoP"> <!-- affichage -->
  <img src="files/upload/<?php
  if($_SESSION['membre']['photo'] != ""){
    $photo = $_SESSION['membre']['photo'];
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
<div class="grid-1 center" style="margin-top: 20px;"><span style="font-weight: bold;">Message d'humeur :</span><br>
  <form method="POST" action="files/inc/traitement.php">
  <input type="text" name="humeur" value=" <?php if(!empty($_SESSION['membre']['humeur'])){ echo $_SESSION['membre']['humeur'];} ?>" style="width:400px; text-align: center; ">
  <input type="submit" name="subHum" value="modifier">
  </form>
</div>
<div class="grid-1 center" style="margin-top: 20px;"><span style="font-weight: bold;">Centres d'intêret : </span><em>séparé par des virgules</em><br>
<form method="POST" action="files/inc/traitement.php">
  <input type="text" name="int" value="<?php if(!empty($_SESSION['membre']['centre_interet'])){ echo $_SESSION['membre']['centre_interet'];}?>" style="width:400px; text-align: center;">
  <input type="submit" name="subInt" value="modifier">
</form>
</div>



<?php
    include_Once 'files/inc/footer.inc.php';
}
  else{
  header('Location: index.php');
  }
?>
