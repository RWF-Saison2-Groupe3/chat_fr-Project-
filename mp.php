<?php
  session_start();
if (!empty($_SESSION['membre'])) // Si non co renvoie a l'acceuil
{
  include_Once "files/inc/header.inc.php";
  include_Once "files/inc/config.php";
  include_Once "files/inc/nav.inc.php";

  if(!empty($_GET['id'])){
    $id_m =  $_SESSION['membre']['id_user'];
    $query = $mysqli->query("SELECT * FROM message_prive WHERE id_user_un=$_GET[id] OR id_user_deux=$_GET[id]");
    $rep = $query->fetch_assoc();
    
    if($rep['id_user_un'] == $id_m){
        $queriz = $mysqli->query("SELECT * FROM user WHERE id_user=$rep[id_user_deux]");
        $result = $queriz->fetch_assoc();

        //var_dump($result);
    }
    if($rep['id_user_deux'] == $id_m){
        $queriz = $mysqli->query("SELECT * FROM user WHERE id_user=$rep[id_user_un]");
        $result = $queriz->fetch_assoc();

        //var_dump($result);
    }
  }else{
      header('location: 404.php');
  }
?>
<div class="grid-1 center"><h1>Conversation avec&nbsp;<?php echo $result['username'] ?></h1></div>
<div class="grid-1">
    <div class="grid-9 chat">
    <div class="miniPc">
    <a href="view.php?id="><img src="files/upload/no-photo.jpg" alt="photo de profil"></a></div>&nbsp;
    <div class="pseudo"><span>Aaman</span></div>
    <div class="message">&nbsp;<span> :</span>&nbsp;<span>Message interessant</span></div>
    
</div>

<?php
include_once "files/inc/footer.inc.php";
} else {
  header("Location: index.php");
}
?> 