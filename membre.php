<?php
  session_start();
  if (!empty($_SESSION['pseudo'])) // redirige a l'index si pas co --> fin en bas de page
{
  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';
?>
<div class="grid-1 profilMembre">
<div class="grid-1 membre">
  <?php include_Once 'files/inc/nav.inc.php'; ?>
  <h1 class="boxdroite">Bonjour <?php echo $_SESSION['pseudo'] ?></h1><br/><br/>
  <div class="grid-5 boxMid">
    <a href="profil.php"><img src="files/img/profil.png" alt="profil">
    <span class="descImg">Mon profil</span></a>
  </div>
  <div class="grid-5 boxMid">
    <a href=""><img src="files/img/mp.png" alt="messages privés">
    <span class="descImg">Mes messages privés</span></a>
  </div>
  <div class="grid-5 boxMid">
    <a href=""><img src="files/img/amis.png" alt="amis">
    <span class="descImg">Mes amis</span></a>
  </div>
  <div class="grid-5 boxMid">
    <a href="chat.php"><img src="files/img/chatg.png" alt="chat général">
    <span class="descImg">Chat général</span></a>
  </div>
  <div class="grid-5 boxMid">
  <a href=""><img src="files/img/chatpeg.png" alt="chat 18+">
    <span class="descImg">Chat 18+</span></a>
  </div>
  <div class="grid-5 boxMid">
  <a href=""><img src="files/img/logout.jpg" alt="deconnexion">
    <span class="descImg">Me deconnecter</span></a>
  </div>
</div>


</div>
<?php
    include_Once 'files/inc/footer.inc.php';
}
  else{
  header('Location: index.php');
  }
?>
