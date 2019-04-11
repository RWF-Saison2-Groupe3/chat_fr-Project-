<?php
session_start();

$title = 'Error 404';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_Once "files/inc/header.inc.php";
include_Once "files/inc/nav.inc.php";

?>

<div class="grid-1">
    <div class="e404">
        <span>Une erreur est survenue..</span>&nbsp;&nbsp;<img src="files/img/bug.svg" alt="bug"><br /><br /><br />
        <a href="index.php">Revenir a l'acceuil</a>
    </div>
</div>

<?php
include_once "files/inc/footer.inc.php";
?> 