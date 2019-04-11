<?php
session_start();

$title = 'Dé-gradé un membre';

$metasup = '<meta name="robots" content="noindex"><meta name="googlebot" content="noindex">';

include_Once '../../inc/function.php';

if (!connecter()) {
    header('location: ../../connexion.php');
    exit();
}
if (WebMaster() or Admin() or modo()){

    include_Once "../../inc/header.inc.php";
    include_Once "../../inc/config.php";
    include_Once "../../inc/nav.inc.php";
    include_Once "../../inc/footer.inc.php"; 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        executeRequete("UPDATE signalement SET statut=1 WHERE id_signalement=$id");

        header('location: ../gestion_signalement.php?valid=ok');

    } else {
        header('location: ../../../404.php');
        exit();
    }
    
    } else {
        header('location: ../../../index.php');
        exit();
    }   

?>