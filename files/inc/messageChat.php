<?php
session_start();

include_once "function.php";

if(!connecter()){
  header('location: connexion.php');
  exit();

}

// TRAITEMENT FORMULAIRE ENVOIE MESSAGE CHAT GENERAL
if($_POST){
  $_POST['message'] = htmltrim($_POST['message']);
  $_POST['message'] = addslashes($_POST['message']);

    $id = $_SESSION['membre']['id_user'];
    $pseudo = $_SESSION['membre']['username'];
    $photo = $_SESSION['membre']['photo'];
    
if(!empty($_POST['message'])){
    include_Once 'config.php'; // connexion bdd
    executeRequete("INSERT INTO chatg(id_mess, id_m, id_n_m, photo_m, mess_post_g, date_m_serv_g) VALUES(NULL, '$pseudo', '$id' ,'$photo', '$_POST[message]', NOW())") OR DIE ($mysqli->error);
}
}
 header('Location: ../../chat.php');
?>
