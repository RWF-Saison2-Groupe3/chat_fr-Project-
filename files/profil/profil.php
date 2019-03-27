<?php
  session_start();
/*if (!empty($_SESSION["pseudo"]))
{*/
  include_Once "../inc/header.inc.php";
  include_Once "../inc/config.php";
  include_Once "../inc/nav.inc.php";
  
  $query = $mysqli->query("SELECT * FROM user WHERE username=$nom");
  $rep = $query->fetch_assoc();
  var_dump($rep);
?>
<link rel="stylesheet" href="../css/css.css">
<h1 class="centrer">Profil de <?php echo $nom; ?></h1>
<div class="grid-1 centrer">
  <div class="photoP">
    <img src="../upload/<?php echo $result["photo"]; ?>" alt="no photo">
  </div>
</div>
<div class="grid-1 center">
<span class="btn vert">Ajouter au amis </span>
<span class="btn orange"> Ajouter au favoris </span>
<span  class="btn"> Bloquer </span>
</div>
<div class="grid-1 centrer" style="margin-top: 10px;">
  <span>Message d\'humeur :</span><br /><br />
  <span> ah je suis de mauvaise humeur ahahahahahah</span>
</div>
<div class="grid-1 centrer" style="margin-top: 15px;">
<span>Centre d\'interet</span><br />
</div>
<div class="grid-1 centrer" style="margin-top: 20px;">
  <span class="inter">VTT</span><span class="inter">BOUFFFE</span>
</div>
<?php
    include_Once "../inc/footer.inc.php";
/*}
  else{
  header("Location: index.php");
}*/
?>
