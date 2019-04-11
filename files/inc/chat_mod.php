<?php 
session_start();

include_once "config.php";
include_once "function.php";

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

    /* ----------------------------- */
    /*              SIGNALEMENT      */
    /* ----------------------------- */
if (!empty($_GET['sign']) && !empty($_GET['id_m'])) {
    if ($_GET['sign'] && $_GET['id_m']) {
        $id_mess = $_GET['sign'];
        $id_m = $_GET['id_m'];
       executeRequete("INSERT INTO signalement(id_m_signaler, id_mess_signaler) VALUES ($id_m,$id_mess)");
        header('location: ../../chat.php?sing=ok');
    }
}
    /* ----------------------------- */
    /*              MODERATION       */
    /* ----------------------------- */
if (WebMaster() or Admin() or modo()){
    if (!empty($_GET)) {
        if ($_GET['moderation']) {
            $id = $_GET['moderation'];
            $moda = executeRequete("DELETE FROM chatg WHERE id_mess=$id");

            header('location: ../../chat.php?mod=ok');
        }
    }
}



?>