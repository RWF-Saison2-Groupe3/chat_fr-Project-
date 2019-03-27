<?php
session_start();
if (!empty($_SESSION['membre'])) { // Si non co renvoie a l'acceuil

  include_once "files/inc/header.inc.php";
  include_once "files/inc/config.php";
  include_once "files/inc/nav.inc.php";

  $id = $_SESSION['membre']['id_user'];
  $amis = $mysqli->query("SELECT * FROM amis WHERE statut=1 AND id_m_demandeur='$id' OR id_m_receveur='$id'");
  
?>
<div class="grid-1 center"><h1>Ma liste d'amis</h1></div>
  <div class="grid-1">
    <?php
    
      while ($list_amis = $amis->fetch_assoc()) {
        if($list_amis['id_m_demandeur'] == $id){
          //var_dump($list_amis);
          $profil = $mysqli->query("SELECT * FROM user WHERE id_user='$list_amis[id_m_receveur]'");
          $ListProfil = $profil->fetch_assoc();
          echo '<div class="boxAmis">';
          echo '<div class="Amis">';
          echo '<span class="Lprofil"><a href="view.php?id='.$ListProfil['id_user'].'"><img src="files/upload/'.$ListProfil['photo'].'" alt="profil de '.$ListProfil['username'].'"></a></span>';
          echo '<span class="Lprofil"><a href="view.php?id='.$ListProfil['id_user'].'">&nbsp;'.$ListProfil['username'].'</a></span>';
          echo '
          <span class="droite">
          <a class="btnM" href="inbox.php?id='.$ListProfil['id_user'].'">Envoyé un message</a>
          <a class="btnM rouge" href="?id='.$ListProfil['id_user'].'">Supprimé des amis</a>
          </span></div></div>
        ';
        }
        if($list_amis['id_m_receveur'] == $id){
          //var_dump($list_amis);
          $profil = $mysqli->query("SELECT * FROM user WHERE id_user='$list_amis[id_m_demandeur]'");
          $ListProfil = $profil->fetch_assoc();
          echo '<div class="boxAmis">';
          echo '<div class="Amis">';
          echo '<span class="Lprofil"><a href="view.php?id='.$ListProfil['id_user'].'"><img src="files/upload/'.$ListProfil['photo'].'" alt="profil de '.$ListProfil['username'].'"></a></span>';
          echo '<span class="Lprofil"><a href="view.php?id='.$ListProfil['id_user'].'">&nbsp;'.$ListProfil['username'].'</a></span>';
          echo '
          <span class="droite">
          <a class="btnM" href="message.php?id='.$ListProfil['id_user'].'">Envoyé un message</a>
          <a class="btnM rouge" href="?id='.$ListProfil['id_user'].'">Supprimé des amis</a>
          </span></div></div>
        ';
        }
      }
    
  ?>
  </div>
<?php
include_once "files/inc/footer.inc.php";
} else {
  header("Location: index.php");
}
?> 