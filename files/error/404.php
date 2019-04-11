<?php
session_start();

$title = 'Error 404';

include_Once '../inc/function.php';

if(!connecter()){
    header('location: ../../connexion.php');
    exit();
  
}

include_Once "../inc/header.inc.php";
include_Once "../inc/nav.inc.php";

?>
<div class="grid-1 centrer"><h1>Error 404</h1></div>
<div class="grid-1">
    <div class="e404">
        <span>Oups, document non trouvé, l'URL est surement fausse...</span>&nbsp;&nbsp;<img src="<?php echo RACINE_SITE ?>files/img/bug.svg" alt="bug"><br /><br /><br />
        <a href="<?php echo RACINE_SITE ?>/index.php">Revenir a l'acceuil</a>
    </div>
</div>

<?php
include_once "../inc/footer.inc.php";
?> 