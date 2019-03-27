<?php
session_start();
if (!empty($_SESSION['membre'])) { // redirige a l'index si pas co --> fin en bas de page else header location

  include_once 'files/inc/header.inc.php';
  include_once 'files/inc/config.php';
  include_once 'files/inc/nav.inc.php';
  include_once 'files/inc/function.php';


  ?>
<div class="grid-1">
    <h1 class="centrer">Chat Général</h1>
    <p class="centrer petit"><em>Le message le plus récent est tout en haut du chat</em></p>
    <p class="centrer petit">/!\ La page se rafraichit toute les 10 secondes /!\</p>
</div>
<!-- PARTIS JS REFRECH CHAT -->

<!-- partis chat affichage si existant-->
<div class="grid-9 chat" id="test">
    <?php
    $mess = $mysqli->query("SELECT * FROM chatg ORDER BY id_mess DESC LIMIT 10");
    header('refresh: 10;');
    ?>
    <?php while ($message = $mess->fetch_assoc()) {
      echo '<div class="miniPc">';
      echo '<a href="view.php?id=' . $message['id_n_m'] . '"><img src="files/upload/' . $message["photo_m"] . '" alt="photo de profil"></a></div>&nbsp';
      echo '<div class="pseudo"><span>' . $message["id_m"] . '</span></div>';
      echo '<div class="message">&nbsp;<span> :</span><span> ' . $message["mess_post_g"] . '</span></div>';
      if (Admin()) {
        echo '<div  id="droite"><a href="?moderation=' . $message['id_mess'] . '"><span>Modéré</span></a></div>';
      }
      echo '<br />';

      /* MODERATION */
      if (Admin()) {
        if (!empty($_GET)) {
          if ($_GET['moderation'] == $message['id_mess']) {
            //echo $message['id_n_m']; Me renvoie bien l'id séléctionner
            $id = $message['id_mess'];
            $moda = $mysqli->query("DELETE FROM chatg WHERE id_mess=$id");
            //header('location: chat.php');
            $moderation = '<div class="message vert">&nbsp Le message a bien été modéré !</span></div>';
            echo $moderation;
            if (!empty($moderation)) {
              header('Refresh:1; url=chat.php');
            }
            /* $mod = $moda->fetch_assoc(); ME RETOURNE BIEN LE TABLEAU
        var_dump($mod); */
          }
        }
      }
    }
    ?>
</div>
<div id="chatref" class="grid-9 entree">
    <div class="entree">
        <form method="post" autocomplete="off" action="files/inc/messageChat.php">
            <input class="champMess" type="text" id="message" name="message" placeholder="Pas d'insultes, de messages inaproprié ou de données personnels" size="120" required><input type="submit" value="envoyer">
        </form>
    </div>
</div>


<?php
include_once 'files/inc/footer.inc.php';
} else {
  header('Location: index.php');
}

?> 