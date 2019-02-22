<?php
  session_start();
  if (!empty($_SESSION['pseudo'])) // redirige a l'index si pas co --> fin en bas de page else header location
{
  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';
  include_Once 'files/inc/nav.inc.php';
?>
<div class="grid-1">
<h1 class="centrer">Chat Général</h1>
  <p class="centrer petit"><em>Le message le plus récent est tout en haut du chat</em></p>
</div>
<!-- PARTIS JS REFRECH CHAT -->

<!-- partis chat affichage si existant-->
<div class="grid-9 chat">
<?php
  $mess = $mysqli->query("SELECT * FROM chatg ORDER BY id_mess DESC LIMIT 10");
?>
    <?php   while($message = $mess->fetch_assoc()){
      echo '<div class="miniPc">';
      echo '<img src="files/upload/'.$message["photo_m"].'" alt="photo de profil"></div>&nbsp';
      echo '<div class="pseudo"><span>'.$message["id_m"].'</span></div>';
      echo '<div class="message">&nbsp;<span> :</span><span> '.$message["mess_post_g"].'</span></div><br />';
}
?>
</div>
<div id="chatref" class="grid-9 entree">
  <div class="entree"><form method="post" action="files/inc/messageChat.php">
    <input class="champMess" type="text" id="message" name="message" placeholder="Pas d'insultes, de messages inaproprié ou de données personnels" size="120" required><input type="submit" value="envoyer">
  </form></div>
</div>


<?php
    include_Once 'files/inc/footer.inc.php';
}
  else{
  header('Location: index.php');
  }

?>
