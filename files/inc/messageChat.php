<?php
  session_start();
// TRAITEMENT FORMULAIRE ENVOIE MESSAGE CHAT GENERAL
if($_POST){
  $_POST['message'] = addslashes($_POST['message']); // on inclue l'utilisation d'apostrophe dans le message
    $id = $_SESSION['membre']['id_user'];
    $pseudo = $_SESSION['membre']['username'];
    $photo = $_SESSION['membre']['photo'];
    //echo $pseudo;
    //echo $photo;
//  $mysqli->query("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$_POST[pseudo]', '$_POST[message]', NOW())") OR DIE ($mysqli->error);
if(!empty($_POST['message'])){
  //echo 'boucle 2';
    include_Once 'config.php'; // connexion bdd
    $mysqli->query("INSERT INTO chatg(id_mess, id_m, id_n_m, photo_m, mess_post_g, date_m_serv_g) VALUES(NULL, '$pseudo', '$id' ,'$photo', '$_POST[message]', NOW())") OR DIE ($mysqli->error);
}
}
 header('Location: ../../chat.php');
?>
