<?php
  session_start();
if (!empty($_SESSION['membre'])) // Si non co renvoie a l'acceuil
{
  include_Once "files/inc/header.inc.php";
  include_Once "files/inc/config.php";
  include_Once "files/inc/nav.inc.php";

  if(!empty($_GET['id'])){
  $query = $mysqli->query("SELECT * FROM user WHERE id_user=$_GET[id]");
  $rep = $query->fetch_assoc();

    if(mysqli_num_rows($query) == 0){
      header('location: 404.php');
    }
  }

?>
<link rel="stylesheet" href="../css/css.css">
<h1 class="centrer">Profil de <?php echo $rep["username"];?></h1>
<div class="grid-1 centrer">
  <div class="photoP">
    <img src="files/upload/<?php echo $rep["photo"]; ?>" alt="no photo">
  </div>
</div>
<div class="grid-1 center">
  <span class="btn vert">Ajouter aux amis </span>
  <span class="btn orange"> Ajouter aux favoris </span>
  <span  class="btn"> Bloquer </span>
</div>
<div class="grid-1 centrer" style="margin-top: 10px;">
  <span style="font-weight: bold;">Message d'humeur :</span><br /><br />
  <span><?php echo $rep["humeur"]; ?></span>
</div>
<div class="grid-1 centrer" style="margin-top: 15px;">
  <span style="font-weight: bold;">Centre d'interet</span><br />
</div>
<div class="grid-1 centrer" style="margin-top: 20px;">
  <span>
    <?php         
          if(!empty($rep['centre_interet'])){
            $affi1 = explode(",",   $rep["centre_interet"]); // J'explose le char de séparation
            $count = count($affi1); // Je compte combien j'ai de survivants
            for ($i = 0; $i < $count; $i++) { // boucle for jusqu'au nombre de mot j'affiche
              $affi = '<span class="inter">'.$affi1[$i].'</span>';
              echo $affi;
            }
          }else{
            $affi = '<span class="inter">Vide</span>';
            echo $affi;
          }
    ?>
  </span>
</div>
<?php
    include_Once "files/inc/footer.inc.php";
}else{
  header("Location: index.php");
}
?>
