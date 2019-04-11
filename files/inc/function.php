<?php
/* ----------------------------- */
/*              FUNCTIONS        */
/* ----------------------------- */

function htmltrim($string){
    htmlentities(trim($string),ENT_QUOTES);
    return $string;
}

function connecter(){
    if(!isset($_SESSION['membre'])) return false;
    else return true;
}

function WebMaster(){
    if($_SESSION['membre']['statut_m'] == 10 ) return true;
    else return false;
}

function Admin(){
    if($_SESSION['membre']['statut_m'] == 9 ) return true;
    else return false;
}

function modo(){
    if($_SESSION['membre']['statut_m'] == 5) return true;
    else return false;
}

function multiexplode ($delimiters,$string) {
    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function executeRequete($req){
global $mysqli;
$resultat = $mysqli->query($req);
    if(!$resultat){
    die('Erreur sur la requete sql.<br />Message : '.$mysqli->error."<br />Code :".$req."");
    }
    return $resultat; // renvoie un boolean
}

/* ----------------------------- */
/*              VARIABLES        */
/* ----------------------------- */

// email webmaster
$mail_webmaster = 'example@example.com';

// nom du design

$design = 'default_Jonas';

/* ----------------------------- */
/*              CONSTANTES       */
/* ----------------------------- */

define("RACINE_SITE", "/Chat_fr/");
