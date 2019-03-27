<?php
// FUNCTION
function Admin(){
    if($_SESSION['membre']['statut_m'] == 1) return true;
    else return false;
}









// CONSTANTE

//define("PROFIL","profil.php");