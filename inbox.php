<?php
  session_start();
if (!empty($_SESSION['membre'])) // Si non co renvoie a l'acceuil
{
  include_Once "files/inc/header.inc.php";
  include_Once "files/inc/config.php";
  include_Once "files/inc/nav.inc.php";

  $id = $_SESSION['membre']['id_user'];
  $mess = $mysqli->query("SELECT * FROM message_prive WHERE id_user_un='$id' OR id_user_deux='$id' ORDER BY id_message DESC ");
?>
<div class="grid-1 center"><h1>Mes messages privé</h1></div>
<div class="grid-1">
<?php 
  while($listMess = $mess->fetch_assoc()){
    $id_user = $listMess['id_user_un'];
    $id_user_d = $listMess['id_user_deux'];
    //var_dump($listMess);
    //var_dump($_SESSION);

    if($id_user == $_SESSION['membre']['id_user']){
      $profil = $mysqli->query("SELECT * FROM user WHERE id_user='$id_user_d'");
      $ListProfil = $profil->fetch_assoc();
      //var_dump($ListProfil);
        echo '<span class="pm"><a href="mp.php?id='.$ListProfil['id_user'].'"><div class="boxAmis">';
        echo '<div class="Amis">';
        echo '<img src="files/upload/'.$ListProfil['photo'].'" alt="profil de">';
        echo '<span>&nbsp;'.$ListProfil['username'].'</span>';
        echo '
        <span class="droite">
        <span>'.$listMess['contenu'].'</span>&nbsp;&nbsp;<span>'.$listMess['heure'].'</span>
        </span></div><a/></span></div>
        ';
    }
    if($id_user_d == $_SESSION['membre']['id_user']){
      $profil = $mysqli->query("SELECT * FROM user WHERE id_user='$id_user'");
      $ListProfil = $profil->fetch_assoc();
      //var_dump($ListProfil);
      echo '<span class="pm"><a href="mp.php?id='.$ListProfil['id_user'].'"><div class="boxAmis">';
      echo '<div class="Amis">';
      echo '<img src="files/upload/'.$ListProfil['photo'].'" alt="profil de">';
      echo '<span>&nbsp;'.$ListProfil['username'].'</span>';
      echo '
      <span class="droite">
      <span>'.$listMess['contenu'].'</span>&nbsp;&nbsp;<span>'.$listMess['heure'].'</span>
      </span></div></a></span></div>
        ';
    }
}
  var_dump($ListProfil);
?>
</div>

<?php
include_once "files/inc/footer.inc.php";
} else {
  header("Location: index.php");
}
?> 