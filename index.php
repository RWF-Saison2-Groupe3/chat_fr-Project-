<?php
session_start();

$ref = 'membre.php';

$content = 'Je peux modifier la balise de description dynamiquement sur mon site !';

$title = 'Espace membre';

include_Once 'files/inc/function.php';

if(!connecter()){
   header('location: connexion.php');
   exit();

}

include_Once 'files/inc/header.inc.php';
include_Once 'files/inc/config.php';
?>

<div class="grid-1 profilMembre">
   <div class="grid-1 membre">
      <?php include_Once 'files/inc/nav.inc.php'; ?>
      <h1 class="boxdroite">Bonjour <?php echo $_SESSION['membre']['username'] ?></h1><br/><br/>
      
         <?php
         if (!WebMaster() && !modo() && !Admin()) {
            echo '<div class="grid-5 boxMid">
            <a href="profil.php?id=' . $_SESSION['membre']['id_user'] . '">
            <img src="files/img/user.svg" alt="profil"><br>
            <span class="descImg">Mon profil</span></a>';
         }
         if (WebMaster()) {
            echo '<div class="grid-5 boxMid">
            <a href="files/admin/admin.php">
            <img src="files/img/admin.svg" alt="profil"><br>
            <span class="descImg">Panel d\'administration</span></a>';
         }
         if (Admin() or modo()) {
            echo '<div class="grid-5 boxMid">
            <a href="files/admin/admin.php">
            <img src="files/img/admin.svg" alt="profil"><br>
            <span class="descImg">Panel d\'administration</span></a>';
         }
         ?>
      </div>
      <div class="grid-5 boxMid">
         <a href="inbox.php"><img src="files/img/mp.svg" alt="messages privés"><br>
         <span class="descImg">Mes messages privés</span></a>
      </div>
      <div class="grid-5 boxMid">
         <a href="amis.php"><img src="files/img/amis.svg" alt="amis"><br>
         <span class="descImg">Mes amis</span></a>
      </div>
      <div class="grid-5 boxMid">
         <a href="chat.php"><img src="files/img/chat.svg" alt="chat général"><br>
         <span class="descImg">Chat général</span></a>
      </div>
      <div class="grid-5 boxMid">
         <a href="listing_user.php"><img src="files/img/listing_friend.svg" alt="Liste des utilisateurs"><br>
         <span class="descImg">Liste des utilisateurs inscrits</span></a>
      </div>
      <div class="grid-5 boxMid">
         <a href="files/inc/deco.php"><img src="files/img/logout.svg" alt="deconnexion"><br>
         <span class="descImg">Me deconnecter</span></a>
      </div>
   </div>
</div>

<?php
include_Once 'files/inc/footer.inc.php';
?>