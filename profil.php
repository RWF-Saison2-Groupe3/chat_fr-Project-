<?php
session_start();

$title = 'Mon profil';

include_Once 'files/inc/function.php';

if(!connecter()){
  header('location: connexion.php');
  exit();

}

include_Once 'files/inc/header.inc.php';
include_Once 'files/inc/config.php';
include_Once 'files/inc/nav.inc.php';

?>
<div class="all0">
  <div class="grid-1" style="text-align: right;"><em><a style="margin-right: 40px;" href="view.php?id=<?php echo $_GET['id']; ?>">Voir mon profil</a></em></div>
    <div class="grid-1 center">
    <h1 class="profilName">Profil de <?php echo $_SESSION['membre']['username']; ?></h1>
  </div>
  <div class="grid-1 centrer">
    <div class="photoP"> <!-- affichage -->
    <img src="files/upload/<?php
            if ($_SESSION['membre']['photo'] != "") {
                $photo = $_SESSION['membre']['photo'];
            } else {
                $photo = "no-photo.jpg";
            }
            echo $photo; ?>" alt="photo de profil"></div>
    <br/><span>Photo de profil : ( JPG, PNG | max. 10 mo)<br/><br/></span>
    <!-- AVATAR -->
    <form method="POST" action="files/inc/traitement.php" enctype="multipart/form-data" id="formProfil">
      <input type="file" name="avatar" accept="image/jpg, image/png">
      <!-- <input type="submit" name="envoie" value="envoyer"> -->
      <input type="submit" name="clear" value ="✗">
      <div class="grid-1 center" style="margin-top: 20px;"><span style="font-weight: bold;">Message d'humeur :</span><br>
        <!-- HUMEUR-->
        <input class="inputProfil" type="text" name="humeur" value="<?php if (!empty($_SESSION['membre']['humeur'])) echo $_SESSION['membre']['humeur']; ?>" 
        autocomplete="off">
        <!-- <input type="submit" name="subHum" value="modifier"> -->
      </div>
      <div class="grid-1 center" style="margin-top: 20px;"><span style="font-weight: bold;">Centres d'intêret : </span><em>séparé par des virgules</em><br>
        <input class="inputProfil" type="text" name="int" value=" <?php if (!empty($_SESSION['membre']['centre_interet'])) echo $_SESSION['membre']['centre_interet']; ?>"
        autocomplete="off">
        <!-- <input type="submit" name="subInt" value="modifier"> -->
      </div>
      <!-- DESC -->
      <div class="grid-1 center" style="margin-top: 20px;"><span style="font-weight: bold;">Description :</span><br>
      <textarea class="inputProfil" name="description" autocomplete="off" placeholder="Pas d'insultes, de messages inaproprié ou de données personnels" cols="80" rows="10"><?php if (!empty($_SESSION['membre']['description'])) echo $_SESSION['membre']['description']; ?></textarea><br/><br/>
      <input type="submit" name="updateProfil" value="Mettre à jour mon profil">
      </div>
    </form>

  </div>
</div>
<?php
include_Once 'files/inc/footer.inc.php';
?>